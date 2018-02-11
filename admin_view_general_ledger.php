<!-- INSTRUCTIONS: this is the header and footer template for the primary ADMIN pages. Code your forms, tables, etc., below the navigation tags. Placeholders have been included where variables will be displayed based on session login information for the user. Leave these "AS IS" for now. To maintain consistency, please do not change the header information other than where indicated with additional comments. -->

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	<title>Membership and Accounting System (MAS)</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<div class="main-heading">
	<h1>Yokota Sportsmen&#39;s Club</h1>
</div>

<!-- this redirects the user to a signout page where the variables will be reset and the session terminated -->
<div class="signout">
	<a href="signout.php">Sign Out</a>	
</div>

<div class="logininfo">
	<p>[placeholder][placeholder] you are logged in as an ADMIN</p>
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
		<li><a href="admin_view_update_import_price_list.php">Import Inventory</a></li>
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

<div class="filter-box1">
	<input type="text" name="from_date" id="from_date" class="form-control" placeholder="&nbsp;&nbsp;From Date"/>
</div>
<div class="filter-box2">
	<input type="text" name="to_date" id="to_date" class="form-control" placeholder="&nbsp;&nbsp;To Date" />
</div>
<div class="filter-button">
	<input type="button" name="filter" id="filter" value="Filter by Date" />
</div>

<!-- IMPORTANT #3: insert/paste YOUR code below to create the table, form, etc. -->

<table class="user-table"> 
	<thead>
		 <th><a href="admin_view_general_ledger.php?sort=id">ID</a></th> 
		 <th><a href="admin_view_general_ledger.php?sort=date">Date</th> 
		 <th>Receipt #</th> 
	 	 <th><a href="admin_view_general_ledger.php?sort=mem_no">Mbr #</th> 
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

<tbody>
<?php
 include 'database.php';
 $pdo = Database::connect();
 $sql = 'SELECT *
FROM general_ledger a
LEFT JOIN balance b ON a.gen_led_id=b.bal_gen_led_id
LEFT JOIN receipts c ON a.gen_led_id=c.rec_gen_led_id
LEFT JOIN ref_gen_led_expense_type d ON a.gen_led_expense_type=d.ref_gen_led_expense_typ
LEFT JOIN ref_gen_led_transaction_type e ON a.gen_led_transaction_type=e.ref_gen_led_transaction_typ
LEFT JOIN ref_gen_led_income_type f ON a.gen_led_income_type=f.ref_gen_led_income_typ
LEFT JOIN member g ON a.gen_led_users_mem_no=g.mem_no
LEFT JOIN balance h ON a.gen_led_id=h.bal_gen_led_id
LEFT JOIN users i ON a.gen_led_add_by=i.user_mem_no';

if ($_GET['sort'] == 'id')
{
	$sql .= " ORDER BY gen_led_id";
}
elseif ($_GET['sort'] == 'date')
{
	$sql .= " ORDER BY gen_led_trans_date";
}
elseif ($_GET['sort'] == 'mem_no')
{
	$sql .= " ORDER BY mem_no";
}

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
					echo '<td>'. $row['user_name'] . '</td>';
					echo '<td><a class="btn" href="admin_user_receipt.php?mem_no='.$row['mem_no'].'">Print</a></td>';
					echo ' ';
					echo '</tr>';
 }
 Database::disconnect();
?>

</tbody>
</table>
<br><br><br><br><br><br>
<div id="button">
	<ul>
		<li><a href="admin_report_quarterly_financial_statement">Print Financial Statement</a></li>
		<li><a href="admin_report_general_ledger_by_date.php">Print General Ledger</a></li>
		<li><a href="admin_main_dashboard.php">Return to Dashboard</a></li>
	</ul>
</div>
<!-- Page footer; please do not change. Footer should always be on the bottom of the page but not fixed. -->
<footer>
<p>This site is intended for personal use by the members of the Yokota Sportsmen&#39;s Club specifically for conducting club business. All rights reserved. Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
