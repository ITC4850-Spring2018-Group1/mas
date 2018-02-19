<!-- INSTRUCTIONS: this is the header and footer template for the primary ADMIN pages. Code your forms, tables, etc., below the navigation tags. Placeholders have been included where variables will be displayed based on session login information for the user. Leave these "AS IS" for now. To maintain consistency, please do not change the header information other than where indicated with additional comments. -->

<?php

require 'database.php';

if(isset($_POST['mem_no'])) {
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$mem_no = $_POST['mem_no'];
	$trans_type = $_POST['trans_type'];
	$expense_type = $_POST['expense_type'];
	$amount = $_POST['amount'];
	$description = $_POST['description'];
	$q = "INSERT INTO general_ledger (gen_led_users_mem_no, gen_led_transaction_type, gen_led_expense_type, gen_led_amount, gen_led_description) VALUES (:mem_no, :trans_type, :expense_type, :amount, :description)";
	$q2 = "INSERT INTO balance (bal_gen_led_id) VALUES (LAST_INSERT_ID())";
	$q3 = "INSERT INTO receipts (rec_gen_led_id) VALUES (LAST_INSERT_ID())";
	$query = $pdo->prepare($q);
	$query2 = $pdo->prepare($q2);
	$query3 = $pdo->prepare($q3);
	$result = $query->execute(array(
	   ":mem_no" => $mem_no,
	   ":trans_type" => $trans_type,
	   ":expense_type" => $expense_type,
	   ":amount" => $amount,
	   ":description" => $description
));
	$query2->execute();
	$query3->execute();
		Database::disconnect();
		header("Location: admin_view_general_ledger.php");
}

?>

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
	<h3>Post Income/Expenses (Non-Sales)</h3>
</div>
<br>
<!-- IMPORTANT #3: insert/paste YOUR code below to create the table, form, etc. -->
<div id="search-by">
<h4>Search for Member by Name:</h4>
</div><br>

<form action="" method="post">
<div class="select-name">
	<label>Member Name:</label>
		<select name="mem_no">
		<option value="">Select Last/First Name</option>
		<option value="1">Kidder, Jason</option>
		<option value="2">Jones, Catherine</option></div><br>
		</select>
</div><br>

<div class="select-trans">
	<label>Transaction Type:</label>
	<select name="trans_type">
		<option value="">Select Transaction Type</option>
		<option value="I">Income</option>
		<option value="E">Expense</option>
	</select>
</div><br>

<div class="select-inc-exp-type">
	<label>Income/Expense Type:</label>
	<select name="expense_type">
		<option value="">Select Type</option>
		<option value="AD">I - Annual Dues</option>
		<option value="RD">I - Renewal Dues</option>
		<option value="FD">I - Fundraiser</option>
		<option value="DO">I - Donation</option>
		<option value="M">E - Meeting</option>
		<option value="T">E - Trip Reimbursement</option>
		<option value="O">E - Other</option>
		<option value="S">E - Supplies</option>
	</select>
</div><br>

<div class="amount">
	<label>Amount:</label>
	<input type="text" name="amount">
</div><br>

<div class="description">
	<label>Description:</label>
	<textarea type="text" rows="4" cols="20" wrap="soft" name="description"></textarea>
</div>

<div class="submit-inc-exp"><br>
	<button type="submit" name="submit" class="submit-inc-exp">Submit</button><br><br><br>
	<a class="btn" href="admin_main_dashboard.php">Back</a>
	</div>
	
<div class="reset">
	<button type="reset" value="Reset">Reset</button>
</div>

</form>


<!-- Page footer; please do not change. Footer should always be on the bottom of the page but not fixed. -->
<footer>
<p>This site is intended for personal use by the members of the Yokota Sportsmen&#39;s Club specifically for conducting club business. All rights reserved. Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
</body>
</html>