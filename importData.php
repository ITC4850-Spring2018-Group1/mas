<?php
//load the database configuration file
include 'dbConfig.php';

if(isset($_POST['importSubmit'])){
    
    //validate whether uploaded file is a csv file
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            //open uploaded csv file with read only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            //skip first three lines
            fgetcsv($csvFile);
            fgetcsv($csvFile);
            fgetcsv($csvFile);
            
            //parse data from csv file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                //check whether item already exists in database with same serial number
                $prevQuery = "SELECT pri_li_no FROM price_list WHERE pri_li_serial_no = '".$line[12]."'";
                $prevResult = $db->query($prevQuery);
                if($prevResult->num_rows > 0){
                    //update member data
                    $db->query("UPDATE price_list SET pri_li_no = '".$line[0]."', pri_li_item_no = '".$line[1]."', pri_li_manufacturer = '".$line[2]."', pri_li_model = '".$line[3]."', pri_li_kind = '".$line[4]."', pri_li_type = '".$line[5]."', pri_li_gauge = '".$line[6]."', pri_li_bbl  = '".$line[7]."', pri_li_choke = '".$line[8]."', pri_li_quantity = '".$line[9]."', pri_li_price = '".$line[10]."', pri_li_description = '".$line[11]."', pri_li_comment = '".$line[13]."' WHERE pri_li_serial_no = '".$line[12]."'");
                }else{
                    //insert member data into database
                    $db->query("INSERT INTO price_list (pri_li_no, pri_li_item_no, pri_li_manufacturer, pri_li_model, pri_li_kind, pri_li_type, pri_li_gauge, pri_li_bbl, pri_li_choke, pri_li_quantity, pri_li_price, pri_li_description, pri_li_serial_no, pri_li_comment) VALUES ('".$line[0]."','".$line[1]."','".$line[2]."','".$line[3]."','".$line[4]."','".$line[5]."','".$line[6]."','".$line[7]."','".$line[8]."','".$line[9]."','".$line[10]."','".$line[11]."','".$line[12]."','".$line[13]."')");
                }
            }
            
            //close opened csv file
            fclose($csvFile);

            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

//redirect to the listing page
header("Location: admin_view_update_import_price_list.php".$qstring);