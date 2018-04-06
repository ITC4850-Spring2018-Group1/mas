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
	
<!-- files needed for datatables installation -->
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/jqueryui/dataTables.jqueryui.js"></script>
<link rel="stylesheet" 
href="https://code.jquery.com/ui/1.10.13/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" 
href="https://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/jqueryui/dataTables.jqueryui.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="script1.js"></script>

<link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/jquery.dataTables_themeroller.css" rel="stylesheet" data-server="1.9.4" data-require="datatables@*" />
<link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/jquery.dataTables.css" rel="stylesheet" data-server="1.9.4" data-require="datatables@*" />
<link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/demo_table_jui.css" rel="stylesheet" data-server="1.9.4" data-require="datatables@*" />
<link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/demo_table.css" rel="stylesheet" data-server="1.9.4" data-require="datatables@*" />
<link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/demo_page.css" rel="stylesheet" data-server="1.9.4" data-require="datatables@*" />
<link data-require="jqueryui@*" data-server="1.10.0" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/css/smoothness/jquery-ui-1.10.0.custom.min.css" />


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
		<li><a href="admin_post_income_expenses.php">Post Income/Expenses</a></li>
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
	<h3>General Ledger (view only)</h3>
</div>
<br>
<div class="input-daterange">
	<input type="text" id="min" name="min" class="form-control">
	<span class="input-group-addon">to</span>
	<input type="text" id="max" name="max" class="form-control">
</div>
<!-- IMPORTANT #3: insert/paste YOUR code below to create the table, form, etc. -->
<table class="user-table" id="datatable"> 
	<thead>
		 <th>ID</a></th> 
		 <th>Date</th> 
		 <th>Receipt #</th> 
	 	 <th>Mbr #</th> 
		 <th>First Name</th> 
		 <th>Last Name</th> 
		 <th>Description</th> 
		 <th>Transaction Type</th> 
		 <th>(-/+) Amount</th> 
		 <th>Expense Type</th> 
		 <th>Income type</th> 
		 <th>Balance</th> 
		 <th>Added By</th> 
		 <th>Action</th>
 	</thead>

	<tfoot>
		<th>ID</a></th> 
			 <th>Date</th> 
			 <th>Receipt #</th> 
		 	 <th>Mbr #</th> 
			 <th>First Name</th> 
			 <th>Last Name</th> 
			 <th>Description</th> 
			 <th>Transaction Type</th> 
			 <th>(-/+) Amount</th> 
			 <th>Expense Type</th> 
			 <th>Income type</th> 
			 <th>Balance</th> 
			 <th>Added By</th> 
			 <th>Action</th>
	</tfoot>
<tbody>
<?php
 include 'database.php';
 $pdo = Database::connect();
 $sql = 'SELECT * FROM general_ledger a
LEFT JOIN balance b ON a.gen_led_id=b.bal_gen_led_id
LEFT JOIN receipts c ON a.gen_led_id=c.rec_gen_led_id
LEFT JOIN ref_gen_led_expense_type d ON a.gen_led_expense_type=d.ref_gen_led_expense_typ
LEFT JOIN ref_gen_led_transaction_type e ON a.gen_led_transaction_type=e.ref_gen_led_transaction_typ
LEFT JOIN ref_gen_led_income_type f ON a.gen_led_income_type=f.ref_gen_led_income_typ
LEFT JOIN member g ON a.gen_led_users_mem_no=g.mem_no
LEFT JOIN balance h ON a.gen_led_id=h.bal_gen_led_id
LEFT JOIN users i ON a.gen_led_add_by=i.user_mem_no';

foreach ($pdo->query($sql) as $row) {
		echo '<tr>';
		echo '<td>'. $row['gen_led_id'] . '</td>';
		echo '<td>'. $row['gen_led_trans_date'] . '</td>';
		echo '<td>'. $row['rec_receipt_no'] . '</td>';
		echo '<td>'. $row['mem_no'] . '</td>';
		echo '<td>'. $row['mem_fname'] . '</td>';
		echo '<td>'. $row['mem_lname'] . '</td>';
		echo '<td>'. $row['gen_led_description'] . '</td>';
		echo '<td>'. $row['ref_gen_led_transaction_desc'] . '</td>';
		echo '<td>'. $row['gen_led_amount'] . '</td>';
		echo '<td>'. $row['ref_gen_led_expense_desc'] . '</td>';
		echo '<td>'. $row['ref_gen_led_income_desc'] . '</td>';
		echo '<td>'. $row['bal_acct_balance'] . '</td>';
		echo '<td>'. $row['gen_led_add_by'] . '</td>';
		echo '<td><a class="btn" href="admin_user_receipt.php?rec_receipt_no='.$row['rec_receipt_no'].'">View Receipt</a></td>';
		echo ' ';
		echo '</tr>';
 }
Database::disconnect();
?>
</tbody>
</table>

<br><br><br>
<div id="button">
	<ul>
		<li><a href="admin_report_quarterly_financial_statement.php">Print Financial Statement</a></li>
		<li><a href="admin_view_update_import_price_list.php">View Inventory</a></li>
		<li><a href="admin_main_dashboard.php">Return to Dashboard</a></li>
	</ul>
</div>
<br><br><br><br><br>
<!-- Page footer; please do not change. Footer should always be on the bottom of the page but not fixed. -->
<footer>
<p>This site is intended for personal use by the members of the Yokota Sportsmen&#39;s Club specifically for conducting club business. All rights reserved. Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
</body>
</html>




























