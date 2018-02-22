<!-- INSTRUCTIONS: this is the header and footer template for the primary ADMIN pages. Code your forms, tables, etc., below the navigation tags. Placeholders have been included where variables will be displayed based on session login information for the user. Leave these "AS IS" for now. To maintain consistency, please do not change the header information other than where indicated with additional comments. -->

<?php
require 'database.php';

if(isset($_POST['mem_no'])) {
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$mem_no = $_POST['mem_no'];
	$serial_no = $_POST['serial_no'];
	$amount = $_POST['amount'];
	$trans_type = 'I';
	$q = "INSERT INTO general_ledger (gen_led_users_mem_no, gen_led_description, gen_led_transaction_type, gen_led_income_type, gen_led_amount) VALUES (:mem_no, '$serial_no', '$trans_type', 'SF', :amount)";
	$q2 = "INSERT INTO balance (bal_gen_led_id, bal_trans_type, bal_trans_amount) VALUES ((LAST_INSERT_ID()), '$trans_type', '$amount')";
	$q3 = "INSERT INTO receipts (rec_gen_led_id) VALUES (LAST_INSERT_ID())";
	$q4 = "INSERT INTO atf (atf_mem_no, atf_serial_no, atf_status_cd) VALUES ('$mem_no', '$serial_no', 'N')";	
	
	$query = $pdo->prepare($q);
	$query2 = $pdo->prepare($q2);
	$query3 = $pdo->prepare($q3);
	$query4 = $pdo->prepare($q4);
	
	$result = $query->execute(array(
	   ":mem_no" => $mem_no,
	   ":amount" => $amount,
));
	$query2->execute();
	$query3->execute();
	$query4->execute();
	
	Database::disconnect();
	header("Location: admin_post_sales_checkout_success.php");
		}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="css/new_master_stylesheet.css">
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
		<li><a href="admin_view_general_ledger.php">View General Ledger</a></li>
		<li><a href="admin_view_update_import_price_list.php">View Price Listing</a></li>
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
	<h3>Post Sales/Checkout</h3>
</div>
<br>
<!-- IMPORTANT #3: insert/paste YOUR code below to create the table, form, etc. -->
<div id="search-by">
<h4>Search for Member by Name:</h4>
</div><br>

<form action="" method="post">
<div class="select-name">
	<label>Last/First:</label>
		<select name="mem_no">
			<option value="">Select Member Name</option>
			<?php
				require_once 'start.php';
				$usersQuery = "SELECT mem_no, mem_lname, mem_fname FROM member ORDER BY mem_lname";
				$users = $db->query($usersQuery);
			?>
			<?php foreach($users->fetchAll() as $user): ?>
				<option value="<?php echo $user['mem_no']; ?>"><?php echo $user['mem_lname']; ?><?php echo ", "; ?><?php echo $user['mem_fname']; ?></option>
			<?php endforeach; 
			Database::disconnect();?>		
		</select>
</div>
<br>
<div id="search-by">
<h4>Search for Item from Price Listing:</h4>
</div><br>

<div class="select-item">
<label>Serial #:</label>
<select name="serial_no">
	<option value="">Select Serial Number</option>
	<?php
		require_once 'start.php';
		$serialQuery = "SELECT * FROM price_list ORDER BY pri_li_serial_no";
		$serials = $db->query($serialQuery);
	?>
	<?php foreach($serials->fetchAll() as $serial): ?>
		<option value="<?php echo $serial['pri_li_serial_no']; ?>"><?php echo $serial['pri_li_serial_no']; ?><?php echo ", "; ?><?php echo $serial['pri_li_manufacturer']; ?><?php echo ", "; ?><?php echo $serial['pri_li_gauge']; ?></option>
	<?php endforeach;   
	Database::disconnect();?>?>
	</select>

<!-- 
<table class="user-table"> 
	<thead>
		 <th>Member #</a></th> 
		 <th>First</th> 
	 	 <th>Last</th> 
		 <th>Serial #</th> 
		 <th>Item#</th> 
		 <th>Manufacturer</th> 
		 <th>Model</th> 
		 <th>Kind</th> 
	</thead>

</tbody>

</table>-->
<br><br>
</div>
<div id="fee-collected">
<h4>Enter Fee Collected (Per Item):</h4>
</div><br>

<div class="amount2">
	<label>Amount ($):</label>
	<input type="text" name="amount">
</div><br>

<div class="button-checkout"><br>
	<button type="submit" name="submit" class="button-checkout">Complete Checkout</button><br><br>
	<a class="btn2" href="admin_main_dashboard.php">Back</a>
	</div>
	
<div class="reset2">
	<button type="reset" value="Reset">Reset</button>
</div>
</form>

<!-- Page footer; please do not change. Footer should always be on the bottom of the page but not fixed. -->
<footer>
<p>This site is intended for personal use by the members of the Yokota Sportsmen&#39;s Club specifically for conducting club business. All rights reserved. Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
</body>
</html>
