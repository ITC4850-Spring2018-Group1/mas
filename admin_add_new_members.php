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
<!-- INSTRUCTIONS: this is the header and footer template for the primary USER pages. Code your forms, tables, etc., below the navigation tags. Placeholders have been included where variables will be displayed based on session login information for the user. Leave these "AS IS" for now. To maintain consistency, please do not change the header information other than where indicated with additional comments. -->

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
		<li><a href="admin_post_income_expenses.php">Import Inventory</a></li>
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

<div class="formbox">
		<div class="row">
			<div class="column">
				<div class="userinfo">
					<h3>Member Information</h3>
				</div>
				<form style="margin: 0px;" action="/user_membership_page.php">
					
					<label for="firstname">First Name</label>
					<input id="first-name" type="text" name="fname">

					<label for="middlename">Middle Name</label>
					<input id="middle-name" type="text" name="fname" value="">
					
					<label for="lastame">Last Name</label>
					<input id="last-name" type="text" name="fname" value="">
					
					<label for="dutyphone">Duty Phone</label>
					<input id="duty-phone" type="text" name="fname" value="">
					
					<label for="cellnumber">Cell Number</label>
					<input id="cellnumber" type="text" name="fname" value="">
					
					<label for="street">Street</label>
					<input id="street" type="text" name="fname" value="">
					
					<label for="city">City</label>
					<input id="city" type="text" name="fname" value="">
					
					<label for="state">State</label>
					<input id="state" type="text" name="fname" value="">

					<label for="zipcode">Zip Code</label>
					<input id="zipcode" type="text" name="fname" value="">
					
					<label for="email">Email</label>
					<input id="email" type="email" name="fname" value="">
					
					<label for="installation">Installation</label>
					<input id=" installation" type="text" name="fname" value="">
					
					<label for="remarks">Remarks</label>
					<textarea name="message" style="min-width: 50%; max-width:50%; height: 90px;"></textarea>
					
					<label for="position">Position</label>
					<input id="position" type="text" name="fname" value="">
				</form>
			</div>
			<div class="column">
				<div class="userinfo">
					<h3>User Information</h3>
				</div>
				<form style="margin: 0px;" action="/user_membership_page.php">
					<label for="username">Username </label>
					<input id="username" type="text" name="fname" value="">
					
		            <label for="firstname">First Name</label>
		            <input id="firstName" type="text">

		            <label for="lastname">Last Name</label>
		            <input id="lastName" type="text">

		            <label for="job">Job</label>
		            <input id="job" type="text">

		            <label for="age">Age</label>
		            <input id="age" type="text">

		            <label for="email">Email</label>
		            <input id="email" type="email">
        			
        			<label for="password">Password</label>
        			<input id="password" type="text">

        			<label for="user-role">User Role</label>
        			<input id="user-role" type="text">
				</form>
				<div class="userinfo">
					<h3>Family Member</h3>
				</div>
				<form style="margin: 0px;" action="/user_membership_page.php">
					<label for="firstname">First Name </label>
					<input type="text" name="fname">
					
		            <label for="middleinitial">Middle Initial</label>
		            <input id="firstName" type="text">

		            <label for="lastname">Last Name</label>
		            <input id="lastName" type="text">

		            <label for="job">Cell Number</label>
		            <input id="job" type="text">

		            <label for="email">Email</label>
		            <input id="email" type="email">

		            <label for="installation">Installation</label>
		            <input id="installation" type="text">

		            <label for="remarks">Remarks</label>
		            <textarea name="message" style="min-width: 50%; max-width:50%; height: 90px;"></textarea>
				</form>
			</div>
		</div>
		<br><br>
		<div class="bottombuttons">
<?php
session_start();
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?> 
			<button type="coolbutton">Add Member</button>

			<button type="coolbutton">Clear</button>
		</div>
</div>
<br>
<br>

<!-- Page footer; please do not change. Footer should always be on the bottom of the page but not fixed. -->
<footer>
<p>This site is intended for personal use by the members of the Yokota Sportsmen&#39;s Club specifically for conducting club business. All rights reserved. Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
</footer>
</body>
</html>
