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
  
if( $_SESSION['sess_user_type'] == "U" || $_SESSION['sess_user_type'] == "A") {
	
	  }
else {
	header('Location: index.php');
	}
	
require 'database.php';
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$id = $_SESSION["sess_user_id"];
	$sql = "SELECT * FROM member a
	LEFT JOIN family b ON a.mem_no=b.fam_assoc_mem_no
	LEFT JOIN membership c ON a.mem_no=c.membership_no
	WHERE mem_no = $id";
	$q = $pdo->prepare($sql);
	$q->execute();
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();

?> 
<!-- INSTRUCTIONS: this is the header and footer template for the primary USER pages. Code your forms, tables, etc., below the navigation tags. Placeholders have been included where variables will be displayed based on session login information for the user. Leave these "AS IS" for now. To maintain consistency, please do not change the header information other than where indicated with additional comments. -->

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
<div class="logo-admin">
	<img src="images/ysc2_logo.png" alt="logo">
</div>

<!-- this redirects the user to a signout page where the variables will be reset and the session terminated -->
<div class="signout1">
	<a href="logout.php">Sign Out</a>	
</div>

<div class="logininfo1">
	<?php echo '<p>Welcome ' . $_SESSION["sess_username"].'! You are logged in as an MEMBER</p>'; ?> 
</div>
<br>
<br>
<br>
<br>
<!-- IMPORTANT #1: change the links to the pages in which users should be directed for YOUR specific wireframe as well as the text to display on the button -->
<div class="nav-user">
	<ul>
		<li><a href="user_view_edit_personal_information.php">View Profile</a></li>
		<li><a href="user_view_amounts_paid.php">View Amounts Paid</a></li>
		<li><a href="user_view_purchase_history.php">View Purchase History</a></li>
		<li><a href="user_view_update_ATF_status.php">View ATF Status</a></li>
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
	<h3>User View/Edit Personal Information</h3>
</div>
<!-- IMPORTANT #3: insert/paste YOUR code below to create the table, form, etc. -->
<div class="form">
<form id="add_members" method="post" action="">
<div class="left_column"><br>
		<h3>Member Information</h3><br>
		<div id="label-right-justify1">
		<label for="mem_fname">First Name:</label>
		<input id="mem_fname" required type="text" readonly="readonly" style="background-color: #F3F2F2" name="mem_fname" value="<?php echo $data['mem_fname'];?>" ><br><br>
		
		<label for="mname">Middle Name:</label>
		<input id="mname" required type="text" style="background-color: #F3F2F2" readonly="readonly" name="mname" value="<?php echo $data['mem_mi'];?>"><br><br>
				
		<label for="lname">Last Name:</label>
		<input id="lname" required type="text" readonly="readonly" style="background-color: #F3F2F2" name="lname" value="<?php echo $data['mem_lname'];?>"><br><br>
		
		<label for="duty">Duty Phone:</label>
		<input id="duty" required type="tel" name="duty" readonly="readonly" style="background-color: #F3F2F2" placeholder="22x-xxxx" value="<?php echo $data['mem_duty_ph'];?>"><br><br>
				
		<label for="cell">Cell Number:</label>
		<input id="cell" required type="text" readonly="readonly" style="background-color: #F3F2F2" name="cell" value="<?php echo $data['mem_cell_number'];?>"><br><br>
		
		<label for="street">Street:</label>
		<input id="street" required type="text" readonly="readonly" style="background-color: #F3F2F2" name="street" value="<?php echo $data['mem_add_street'];?>"><br><br>
		
		<label for="city">City:</label>
		<input id="city" required type="text" readonly="readonly" style="background-color: #F3F2F2" name="city" value="<?php echo $data['mem_add_city'];?>"><br><br>
		
		<label for="state">State:</label>
		<input id="state" required type="text" readonly="readonly" style="background-color: #F3F2F2" name="state" value="<?php echo $data['mem_add_state'];?>"><br><br>

		<label for="zip">Zip Code:</label>
		<input id="zip" required type="text" readonly="readonly" style="background-color: #F3F2F2" name="zip" value="<?php echo $data['mem_add_zip'];?>"><br><br>
		
		<label for="email">Email:</label>
		<input id="email" required type="email" readonly="readonly" style="background-color: #F3F2F2" name="email" value="<?php echo $data['mem_email'];?>"><br><br>
		
		<label for="installation">Installation:</label>
		<input id="installation" required type="text" readonly="readonly" style="background-color: #F3F2F2" name="email" value="<?php echo $data['mem_installation'];?>"><br><br>
		
		<label for="position">Position:</label>
		<input id="position" readonly="readonly" style="background-color: #F3F2F2" type="text" name="position" value="<?php echo $data['mem_position'];?>"><br><br>
		
		<label for="category">Category:</label>
		<input id="category" readonly="readonly" style="background-color: #F3F2F2" required type="text" name="category" value="<?php echo $data['mem_category_cd'];?>"><br><br>
		
		<label for="memberType">Member Type:</label>
		<input id="memberType" readonly="readonly" style="background-color: #F3F2F2" required type="text" name="memberType" value="<?php echo $data['mem_type'];?>"><br><br>
		
		<label for="memberAdded">Member Added:</label>
		<input id="memberAdded" readonly="readonly" style="background-color: #F3F2F2" required type="text" name="memberAdded" value="<?php echo $data['mem_add_date_time'];?>"><br><br>
		
		<label for="memberLastUpdated">Member Updated:</label>
		<input id="memberLastUpdated" readonly="readonly" required type="text" name="memberLastUpdated" value="<?php echo $data['mem_last_updated'];?>" style="background-color: #F3F2F2;"><br><br>
		
		<label for="memberUpdatedBy">Member Updated By:</label>
		<input id="memberUpdatedBy" readonly="readonly" style="background-color: #F3F2F2" required type="tetxt" name="memberUpdatedBy" value="<?php echo $data['mem_updated_by'];?>"><br><br>
		
		</div>
</div>
<div class="right_column"><br>
		<h3>Family Member</h3><br>
		<div id="label-right-justify2">
		<label for="fam_mem_no">Family Member #: </label>
		<input id="fam_mem_no" readonly="readonly" type="text" style="background-color: #F3F2F2" name="fam_mem_no" value="<?php echo $data['fam_mem_no'];?>"><br><br>
		
		<label for="fam_fname">First Name: </label>
		<input id="fam_fname" readonly="readonly" type="text" style="background-color: #F3F2F2" name="fam_fname" value="<?php echo $data['fam_fname'];?>"><br><br>
            
		<label for="fam_mi">Middle Initial:</label>
        <input id="fam_mi" readonly="readonly" name="fam_mi" style="background-color: #F3F2F2" type="text" value="<?php echo $data['fam_mi'];?>"><br><br>

        <label for="fam_lname">Last Name:</label>
        <input id="fam_lname" readonly="readonly" name="fam_lname" style="background-color: #F3F2F2" type="text" value="<?php echo $data['fam_lname'];?>"><br><br>

		<label for="fam_cell">Cell:</label>
		<input id="fam_cell" readonly="readonly" style="background-color: #F3F2F2" name="fam_cell" type="tel" value="<?php echo $data['fam_cell_number'];?>"><br><br>

        <label for="fam_email">Email:</label>
        <input id="fam_email" readonly="readonly" style="background-color: #F3F2F2" name="fam_email" type="email" value="<?php echo $data['fam_email'];?>"><br><br>

        <label for="fam_installation">Installation:</label>
		 <input id="fam_installation" readonly="readonly" style="background-color: #F3F2F2" name="fam_installation" type="text" value="<?php echo $data['fam_installation'];?>"><br><br>
	   </div>
		<br>
		<h3>Membership</h3><br>
		<label for="eff_date">Effective Date: </label>
		<input id="eff_date" readonly="readonly" type="text" style="background-color: #F3F2F2" name="eff_date" value="<?php echo $data['membership_eff_date'];?>"><br><br>
		
		<label for="eff_date">Termination Date: </label>
		<input id="eff_date" readonly="readonly" type="text" style="background-color: #F3F2F2" name="eff_date" value="<?php echo $data['membership_term_date'];?>"><br><br>
</div>
</div>
<!-- I<div id="button5">
<input id="submit" type="submit" name="" value="[enter label]" style="width:150px";>
</div>-->
</form>
<br>
</div>
<div id="center6">
<div id="button6">
<a href="mailto:YSCsecretary@gmail.com">Email Admin</a></p>
</div>
</div>
<br>
<br>
<br>
<!-- Page footer; please do not change. Footer should always be on the bottom of the page but not fixed. -->
<footer>
<p>This site is intended for personal use by the members of the Yokota Sportsmen&#39;s Club specifically for conducting club business. All rights reserved. Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
</footer>
</body>
</html>























