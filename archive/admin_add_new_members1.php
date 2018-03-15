<br>
<?php  
session_start();
if(isset($_SESSION['sess_username']))  
 {  
	echo '<h6>Your session is currently ACTIVE '.$_SESSION['sess_username'].'</h6>';    
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
<!-- INSTRUCTIONS: this is the header and footer template for the primary USER pages. Code your forms, tables, etc., below the navigation tags. Placeholders have been included where variables will be displayed based on session login information for the user. Leave these "AS IS" for now. To maintain consistency, please do not change the header information other than where indicated with additional comments. -->

<?php
require 'database.php';
if(isset($_POST["submit"])) {
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$mem_fname = $_POST['mem_fname'];
	$mem_mname = $_POST['mname'];
	$mem_lname = $_POST['lname'];
	$mem_duty = $_POST['duty'];
	$mem_cell = $_POST['cell'];
	$mem_street = $_POST['street'];
	$mem_city = $_POST['city'];
	$mem_state = $_POST['state'];
	$mem_zip = $_POST['zip'];
	$mem_email = $_POST['email'];
	$mem_installation = $_POST['installation'];
	$mem_remarks = $_POST['remarks'];
	$mem_position = $_POST['position'];
	$mem_category = $_POST['category'];
	$mem_usertype = $_POST['usertype'];
	$mem_updated_by = $_POST['sess_username'];

	$users_username = $_POST['username'];
	$users_password = $_POST['password'];
	$users_user_role = $_POST['user_role'];

$q = "INSERT INTO member (mem_fname, mem_mi, mem_lname, mem_duty_ph, mem_cell_number, mem_add_street, mem_add_city, mem_add_state, mem_add_zip, mem_email, mem_installation, mem_remarks, mem_position, mem_category_cd, mem_type, mem_updated_by) VALUES (:mem_fname, :mem_mname, :mem_lname, :mem_duty, :mem_cell, :mem_street, :mem_city, :mem_state, :mem_zip, :mem_email, :mem_installation, :mem_remarks, :mem_position, :mem_category, :mem_usertype, '$mem_updated_by')";
//$q2 = "INSERT INTO users (username, password, user_type, user_mem_no)VALUES(:users_username, :users_password, :users_user_role, (LAST_INSERT_ID()))"; 

$query = $pdo->prepare($q);
//$query2 = $pdo->prepare($q2);

$result = $query->execute(array(
	    ":mem_fname" => $mem_fname,
		":mem_mname" => $mem_mname, 
		":mem_lname" => $mem_lname,
		":mem_duty" => $mem_duty, 
		":mem_cell" => $mem_cell, 
		":mem_street" => $mem_street,
		":mem_city" => $mem_city, 
		":mem_state" => $mem_state, 
		":mem_zip" => $mem_zip, 
		":mem_email" => $mem_email, 
		":mem_installation" => $mem_installation,
		":mem_remarks" => $mem_remarks,
		":mem_position" => $mem_position, 
		":mem_category" => $mem_category, 
		":mem_usertype" => $mem_usertype,
		":mem_updated_by" => $mem_updated_by 
));

//$result1 = $query2->execute(array(
//		":users_username" => $users_username,
//		":users_password" => $users_password,
//		":users_user_role" => $users_user_role
//));
Database::disconnect();
header("Location: admin_view_update_membership_summary.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="css/chris_stylesheet.css">
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
		<li><a href="admin_post_income_expenses.php">Post Income/Expense</a></li>
		<li><a href="admin_view_update_membership_summary.php">View Membership</a></li>
		<li><a href="admin_view_update_ATF_status.php">View ATF Status</a></li>
		<li><a href="admin_post_income_expenses.php">Post Income/Expenses</a></li>
		<li><a href="admin_view_general_ledger.php">View General Ledger</a></li>
	</ul>
	<br>
</div>
<hr>
<br>
<div class="main-title">
	<h2>Membership And Accounting System</h2>
</div>
<!-- IMPORTANT #2: change the H3 tag to match the title of YOUR specific wireframe -->
<div class="individual-page-title">	
	<h3>Add New Members</h3>
</div>
<!-- IMPORTANT #3: insert/paste YOUR code below to create the table, form, etc. -->
<form id="add_members" method="post" action="" style="width: 900px">
<div class="formbox">
		<div class="row">
			<div class="column">
				<div class="userinfo">
					<h3>Member Information</h3>
				</div>
					<label for="mem_fname">First Name</label>
					<input id="mem_fname" type="text" name="mem_fname" required value="">

					<label for="middlename">Middle Name</label>
					<input id="mname" type="text" name="mname" required value="">
					
					<label for="lastame">Last Name</label>
					<input id="lname" type="text" name="lname" required value="">
					
					<label for="dutyphone">Duty Phone</label>
					<input id="duty" type="tel" name="duty" required value="">
					
					<label for="cellnumber">Cell Number</label>
					<input id="cell" type="text" name="cell" required value="">
					
					<label for="street">Street</label>
					<input id="street" type="text" name="street" required value="">
					
					<label for="city">City</label>
					<input id="city" type="text" name="city" required value="">
					
					<label for="state">State</label>
					<input id="state" type="text" name="state" required value="">

					<label for="zipcode">Zip Code</label>
					<input id="zip" type="text" name="zip" required value="">
					
					<label for="email">Email</label>
					<input id="email" type="email" name="email" required value="">
					
					<label for="installation">Installation</label>
					<input id=" installation" type="text" name="installation" required value="">
					
					<label for="remarks">Remarks</label>
					<textarea name="remarks" style="min-width: 50%; max-width:50%; height: 90px;"></textarea>
					
					<label for="position">Position</label>
					<input id="position" type="text" name="position" value="">
					
					<label for="category">Category</label>
					<input id="category" type="text" name="category" required value="">
					
					<label for="usertype">Type of User</label>
					<input id="usertype" type="text" name="usertype" required value="">
			</div>
			<div class="column">
				<div class="userinfo">
					<h3>User Information</h3><br>
				</div>
					<label for="username">Username </label>
					<input id="username" type="text" name="username" value="">
		               			
        			<label for="password">Password</label>
        			<input id="password" name="password" type="text" value="">

        			<label for="user-role">User Role</label>
        			<input id="user-role" name="user-role" type="text" value="">
				<div class="userinfo">
					<h3>Family Member</h3><br>
				</div>
					<label for="firstname">First Name </label>
					<input type="text" name="fname">
					
		            <label for="middleinitial">Middle Initial</label>
		            <input id="firstName" type="text">

		            <label for="lastname">Last Name</label>
		            <input id="lastName" type="text">

		            <label for="email">Email</label>
		            <input id="email" type="email">

		            <label for="installation">Installation</label>
		            <input id="installation" type="text">

		            <label for="remarks">Remarks</label>
		            <textarea name="message" style="min-width: 50%; max-width:50%; height: 90px;"></textarea>
			</div>
		</div>
<br><br>
		<div class="bottombuttons">
		<input id="submit" type="submit" name="submit" value="Add Member" style="width:150px";><br><br><br>
		<input id="reset" type="reset" name="reset" value="Clear" style="width:150px";>
		</div>
</div>
</form>
<br>
<br>

<!-- Page footer; please do not change. Footer should always be on the bottom of the page but not fixed. -->
<footer>
<p>This site is intended for personal use by the members of the Yokota Sportsmen&#39;s Club specifically for conducting club business. All rights reserved. Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
</footer>
</body>
</html>























