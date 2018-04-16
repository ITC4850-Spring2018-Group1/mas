<br>
<?php  
session_start();
if(isset($_SESSION["sess_username"]))  
 {  
	echo '<h6>Your session is currently ACTIVE '.$_SESSION["sess_username"].'</h6>';    
 }  
 else  
 {  
	header("location:index.php");  
 }  

if( $_SESSION['sess_user_type'] == "A") {
		
		  }
	else {
		header('Location: index.php');
		}

?>
<!-- INSTRUCTIONS: this is the header and footer template for the primary ADMIN pages. Code your forms, tables, etc., below the navigation tags. Placeholders have been included where variables will be displayed based on session login information for the user. Leave these "AS IS" for now. To maintain consistency, please do not change the header information other than where indicated with additional comments. -->

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Membership and Accounting System (MAS)</title>
	<link rel="stylesheet" type="text/css" href="css/new_master_stylesheet.css">
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/jqueryui/dataTables.jqueryui.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/jquery.dataTables.js"></script>

<link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/jquery.dataTables_themeroller.css" rel="stylesheet" data-semver="1.9.4" data-require="datatables@*" />
<link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/jquery.dataTables.css" rel="stylesheet" data-semver="1.9.4" data-require="datatables@*" />
<link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/demo_table_jui.css" rel="stylesheet" data-semver="1.9.4" data-require="datatables@*" />
<link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/demo_table.css" rel="stylesheet" data-semver="1.9.4" data-require="datatables@*" />
<link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/demo_page.css" rel="stylesheet" data-semver="1.9.4" data-require="datatables@*" />
<link data-require="jqueryui@*" data-semver="1.10.0" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/css/smoothness/jquery-ui-1.10.0.custom.min.css" />
<link href="style.css" rel="stylesheet" />
<script src="script_test.js"></script>

</head>


<body>
<div class="main-heading">
	<h1>Yokota Sportsmen&#39;s Club</h1>
</div>

<!-- this redirects the user to a signout page where the variables will be reset and the session terminated -->
<div class="signout">
	<a href="logout.php">Sign Out</a>	
</div>

<div class="logininfo">
	<?php echo '<p>Welcome ' . $_SESSION["sess_username"].'! You are logged in as an ADMIN</p>'; ?> 
</div>
<br>
<br>
<br>
<br>
<!-- IMPORTANT #1: change the links to the pages in which users should be directed for YOUR specific wireframe as well as the text to display on the button -->
<div class="nav-admin">
	<ul>
		<li><a href="admin_add_new_members.php">Add Membership</a></li>
		<li><a href="admin_view_update_membership_summary.php">View Membership</a></li>
		<li><a href="admin_view_update_ATF_status.php">View ATF Status</a></li>
		<li><a href="admin_post_sales_checkout.php">Post Sales/Checkout</a></li>
		<li><a href="admin_view_general_ledger.php">View General Ledger</a></li>
	</ul>
<br>
</div>
<hr>
<br>

<div class="main-title">
<h2>MEMBERSHIP AND ACCOUNTING SYSTEM</h2>
</div>

<!-- IMPORTANT #2: change the H3 tag to match the title of YOUR specific wireframe -->
<div class="individual-page-title">	
	<h3>View/Update Inventory</h3>
</div>
<br>

<!-- IMPORTANT #3: insert/paste YOUR code below to create the table, form, etc. -->
<table class="user-table" id="datatable">
	<thead>
		 <th>List #</th>
	<!-- <th>Item #</th> -->
		 <th>Serial #</th>
		 <th>Manu</th>
		 <th>Mod</th> 
		 <th>Knd</th> 
		 <th>Typ</th> 
		 <th>Gauge</th> 
		 <th>Bbl</th> 
		 <th>Chk</th> 
		 <th>Qty</th> 
		 <th>Price (&yen;)</th> 
		 <th>Desc</th>
		 <th>Comment</th>
		 <th>Assoc<br>Member #</th>
		 <th>Added</th>
		 <th>Updated</th>
		 <th>Action</th>
	 	</thead>
	<tfoot>
		<th>List #</th>
		<!-- <th>Item #</th> -->
			 <th>Serial #</th>
			 <th>Manu</th>
			 <th>Mod</th> 
			 <th>Knd</th> 
			 <th>Typ</th> 
			 <th>Gauge</th> 
			 <th>Bbl</th> 
			 <th>Chk</th> 
			 <th>Qty</th> 
			 <th>Price (&yen;)</th> 
			 <th>Desc</th>
			 <th>Comment</th>
			 <th>Assoc<br>Member #</th>
			 <th>Added</th>
			 <th>Updated</th>
			 <th>Action</th>
		 	</thead>
	</tfoot>
<tbody>
<?php
 include 'database.php';
 $pdo = Database::connect();
 $sql = 'SELECT *
FROM price_list a
LEFT JOIN atf b ON a.pri_li_serial_no=b.atf_serial_no
ORDER BY pri_li_item_no';
foreach ($pdo->query($sql) as $row) {
	echo '<tr>';
	echo '<td>'. $row['pri_li_no'] . '</td>';
//	echo '<td>'. $row['pri_li_item_no'] . '</td>';
	echo '<td>'. $row['pri_li_serial_no'] . '</td>';
	echo '<td>'. $row['pri_li_manufacturer'] . '</td>';
	echo '<td>'. $row['pri_li_model'] . '</td>';
	echo '<td>'. $row['pri_li_kind'] . '</td>';
	echo '<td>'. $row['pri_li_type'] . '</td>';
	echo '<td>'. $row['pri_li_gauge'] . '</td>';
	echo '<td>'. $row['pri_li_bbl'] . '</td>';
	echo '<td>'. $row['pri_li_choke'] . '</td>';
	echo '<td>'. $row['pri_li_quantity'] . '</td>';
	echo '<td>'. $row['pri_li_price'] . '</td>';
	echo '<td>'. $row['pri_li_description'] . '</td>';
	echo '<td>'. $row['pri_li_comment'] . '</td>';
	echo '<td>'. $row['atf_mem_no'] . '</td>';
	echo '<td>'. $row['pri_li_add_date'] . '</td>';
	echo '<td>'. $row['pri_li_update_date'] . '</td>';
	echo '<td><a class="btn" href="">Update</a></td>';
	echo ' ';
	echo '</tr>';
 }

 Database::disconnect();
?>
</tbody>
</table>

<br><br>
<?php
//load the database configuration file
include 'dbConfig.php';

if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusMsgClass = 'alert-success';
            $statusMsg = 'Data has been inserted and/or updated successfully.';
            break;
        case 'err':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusMsgClass = '';
            $statusMsg = '';
    }
}
?>
<div class="block-center">
<div class="container1">
    <?php if(!empty($statusMsg)){
        echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
    } ?>
    <div class="panel-default">
        <div class="panel-heading">
            <a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();">Import Inventory</a>
        </div><br>
        <div class="panel-body">
            <form action="importData.php" method="post" enctype="multipart/form-data" id="importFrm">
                <input type="file" name="file" /><br><br><br>
                <input type="submit" class="btn-primary" name="importSubmit" value="IMPORT">
            </form>
        </div>
    </div>
</div>
</div>
<br><br><br>
<div id="bottom-return-to-dashboard">
<div id="button-back">
<a class="btn" href="admin_main_dashboard.php">Return to Dashboard</a>
</div>
</div>
<br><br><br><br><br>
<!-- Page footer; please do not change. Footer should always be on the bottom of the page but not fixed. -->
<footer>
<p>This site is intended for personal use by the members of the Yokota Sportsmen&#39;s Club specifically for conducting club business. All rights reserved. Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
</body>
</html>
