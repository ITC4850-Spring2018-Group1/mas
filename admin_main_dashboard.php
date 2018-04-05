<br>
<?php  
 //login_success.php  
 session_start();  
 if(isset($_SESSION["sess_username"]))  
 {  
	echo '<h6>You logged in successfully ' . $_SESSION["sess_username"]. '</h6>';  
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
	<link rel="stylesheet" type="text/css" href="css/new_master_stylesheet.css">
	<title>Membership and Accounting System (MAS)</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- need to add favicon links HERE -->
	</head>

<body>
<div class="admin_dashboard">
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
<div class="main-title">
<h2>MEMBERSHIP AND ACCOUNTING SYSTEM</h2>
</div>
<!-- IMPORTANT #2: change the H3 tag to match the title of YOUR specific wireframe -->
<div class="individual-page-title">	
	<h3>Administrator Dashboard</h3>
	<br>
	<br>
	<p>Please select an option:</p>
</div>
<br>

<!-- IMPORTANT #3: insert/paste YOUR code below to create the table, form, etc. -->
<div class="center-columns">
<div class="column1">
	<div class="dashboard-button1">
		<ul>
			<li><a href="admin_add_new_members.php">Add Membership</a></li>
		</ul>
	</div><br><br>
	<div class="dashboard-button2">
		<ul>
			<li><a href="admin_post_income_expenses.php">Post Income/Expenses</a></li>
		</ul>
	</div><br><br>
	<div class="dashboard-button3">
		<ul>
			<li><a href="admin_view_general_ledger.php">View General Ledger</a></li>
		</ul>
	</div>	
</div>
	
<div class="column2">			
	<div class="dashboard-button4">
		<ul>
			<li><a href="admin_view_update_membership_summary.php">View/Edit Membership</a></li>	
		</ul>
	</div><br><br>
	<div class="dashboard-button5">
		<ul>
			<li><a href="admin_view_update_ATF_status.php">View ATF Status</a></li>
		</ul>
	</div><br><br>
	<div class="dashboard-button6">
		<ul>
			<li><a href="admin_view_update_import_price_list.php">Import Inventory/Price List</a></li>
		</ul>
	</div>
</div>
</div>
<div class="last-button">
<div class="dashboard-button7">
	<ul>
		<li><a href="admin_post_sales_checkout.php">Sales/Checkout</a></li>	
	</ul>
</div>	
</div>		
<br>
<br>
<br><br><br>
<div class="member-portal-link">
	<div id="bottom-return-to-dashboard">
	<div id="button-back">
	<a class="btn" href="user_view_edit_personal_information.php">Access Personal Member Portal</a>
	</div>
	</div>
</div>
<br><br><br><br><br>
<!-- Page footer; please do not change. Footer should always be on the bottom of the page but not fixed. -->
<footer>
<p>This site is intended for personal use by the members of the Yokota Sportsmen&#39;s Club specifically for conducting club business. All rights reserved. Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
</body>
</html>