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
		<li><a href="admin_view_update_ATF_status.php">View ATF Status</a></li>
		<li><a href="admin_post_sales_checkout.php">Post Sales/Checkout</a></li>
		<li><a href="admin_post_income_expenses.php">Post Income/Expenses</a></li>
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
	<h3>Post Sales / Income / Expenses</h3>
</div>
<!-- IMPORTANT #3: insert/paste YOUR code below to create the table, form, etc. -->
<div class="success">
<br>
<p>Your transaction was successful!</p>
</div>


<!-- Page footer; please do not change. Footer should always be on the bottom of the page but not fixed. -->
<footer>
<p>This site is intended for personal use by the members of the Yokota Sportsmen&#39;s Club specifically for conducting club business. All rights reserved. Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
</body>
</html>