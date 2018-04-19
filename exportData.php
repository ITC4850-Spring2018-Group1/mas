<?php
//include database configuration file
include 'dbConfig.php';

//get records from database
$query = $db->query("SELECT * FROM general_ledger a
LEFT JOIN balance b ON a.gen_led_id=b.bal_gen_led_id
LEFT JOIN receipts c ON a.gen_led_id=c.rec_gen_led_id
LEFT JOIN ref_gen_led_expense_type d ON a.gen_led_expense_type=d.ref_gen_led_expense_typ
LEFT JOIN ref_gen_led_transaction_type e ON a.gen_led_transaction_type=e.ref_gen_led_transaction_typ
LEFT JOIN ref_gen_led_income_type f ON a.gen_led_income_type=f.ref_gen_led_income_typ
LEFT JOIN member g ON a.gen_led_users_mem_no=g.mem_no
LEFT JOIN balance h ON a.gen_led_id=h.bal_gen_led_id
LEFT JOIN users i ON a.gen_led_add_by=i.user_mem_no");

if($query->num_rows > 0){
    $delimiter = ",";
    $filename = "GeneralLedger_" . date('Y-m-d') . ".csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    $fields = array('ID', 'Date', 'Receipt #', 'Mbr #', 'First Name', 'Last Name', 'Description', 'Transaction', '(-/+) Amount', 'Expense Type', 'Income type', 'Balance', 'Added By');
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
        $lineData = array($row['gen_led_id'], $row['gen_led_trans_date'], $row['rec_receipt_no'], $row['mem_no'], $row['mem_fname'], $row['mem_lname'], $row['gen_led_description'], $row['ref_gen_led_transaction_desc'], $row['gen_led_amount'], $row['ref_gen_led_expense_desc'], $row['ref_gen_led_income_desc'], $row['bal_acct_balance'], $row['gen_led_add_by']);
        fputcsv($f, $lineData, $delimiter);
    }
    
    //move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;

?>