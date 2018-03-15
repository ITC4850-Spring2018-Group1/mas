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
        			<input id="password" type="text">

        			<label for="user-role">User Role</label>
        			<input id="user-role" type="text">
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

<?php
if(isset($_POST["submit"])) {
$hostname='localhost';
$username='root';
$password='root';

try {
$dbh = new PDO("mysql:host=$hostname;dbname=yokotasp_mas1",$username,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	
$sql = "INSERT INTO member (mem_mi, mem_lname, mem_duty_ph, mem_cell_number, mem_add_street, mem_add_city, mem_add_state, mem_add_zip, mem_email, mem_installation, mem_remarks, mem_position, mem_category_cd, mem_type, mem_fname) VALUES ('".$_POST["mname"]."','".$_POST["lname"]."','".$_POST["duty"]."','".$_POST["cell"]."','".$_POST["street"]."','".$_POST["city"]."','".$_POST["state"]."','".$_POST["zip"]."','".$_POST["email"]."','".$_POST["installation"]."','".$_POST["remarks"]."','".$_POST["position"]."','".$_POST["category"]."','".$_POST["usertype"]."','".$_POST["mem_fname"]."')";
$sql1 = "INSERT INTO users (user_mem_no, username, password, user_type) VALUES ((LAST_INSERT_ID()), '".$_POST["username"]."','".$_POST["password"]."','".$_POST["user-role"]."')";   
if ($dbh->query($sql)) && ($dbh->query($sql1)) {
	echo "<script type= 'text/javascript'>alert('New Record Inserted Successfully');</script>";
	}
	else{
	echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
	}

	$dbh = null;
	}
	catch(PDOException $e)
	{
	echo $e->getMessage();
	}
}
	?>
<!-- Page footer; please do not change. Footer should always be on the bottom of the page but not fixed. -->
<footer>
<p>This site is intended for personal use by the members of the Yokota Sportsmen&#39;s Club specifically for conducting club business. All rights reserved. Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
</footer>
</body>
</html>























