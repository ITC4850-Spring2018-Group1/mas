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
$mem_no = null;
if ( !empty($_GET['mem_no'])) {
		$mem_no = $_REQUEST['mem_no'];
}
 
if ( null==$mem_no ) {
		header("Location: index.php");
} 

else {
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM member a
LEFT JOIN family b ON a.mem_no=b.fam_assoc_mem_no
LEFT JOIN membership c ON a.mem_no=c.membership_no
LEFT JOIN users d ON a.mem_no=d.user_mem_no
WHERE mem_no = $mem_no";
$q = $pdo->prepare($sql);
$q->execute(array($mem_no));
$data = $q->fetch(PDO::FETCH_ASSOC);
Database::disconnect();
}
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
		<li><a href="admin_view_update_import_price_list.php">View Inventory</a></li>
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
	<h3>View/Update Member Information</h3>
</div>
<!-- IMPORTANT #3: insert/paste YOUR code below to create the table, form, etc. -->
<?php
	if(isset($_POST['submit'])){//if the submit button is clicked
	$duty = $_POST['duty'];
	$cell = $_POST['cell'];
	$street = $_POST['street'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];
	$email = $_POST['email'];
	$install = $_POST['installation'];
	$remarks = $_POST['remarks'];
	$position = $_POST['position'];
	$category = $_POST['category'];
	$type = $_POST['memberType'];
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$role = $_POST['role'];
	
	$fam_fname= $_POST['fam_fname'];
	$fam_mi = $_POST['fam_mi'];
	$fam_lname = $_POST['fam_lname'];
	$fam_cell = $_POST['fam_cell'];
	$fam_email = $_POST['fam_email'];
	$fam_installation =$_POST['fam_installation'];
	
	$effDate = $_POST['eff_membership'];
	$termDate = $_POST['term_membership'];
	
	$mem_updated_by = $_SESSION['sess_username'];
	
	$update = "UPDATE member SET mem_duty_ph='$duty', mem_cell_number ='$cell', mem_add_street='$street', mem_add_city='$city', mem_add_state='$state', mem_add_zip='$zip', mem_email='$email', mem_installation='$install', mem_remarks='$remarks', mem_position='$position', mem_category_cd='$category', mem_type='$type', mem_updated_by='$mem_updated_by' WHERE mem_no = $mem_no";
	$update2 = "UPDATE users SET user_type ='$role', username='$username', password='$password' WHERE user_mem_no = $mem_no";
	$update4 = "UPDATE membership SET membership_eff_date='$effDate', membership_term_date='$termDate' WHERE membership_no = $mem_no";
	
	$query = $pdo->prepare($update);
	$query2 = $pdo->prepare($update2);
	$query4 = $pdo->prepare($update4);
	
	$result = $query->execute();
	$result2 = $query2->execute();
	$result4 = $query4->execute();
	
	if($result){ //if the update worked
		if($result2) {
			if($result4) {
				echo "<font color='red'><b>Update successful!</b></font>";	 
			}
		}
	}
}
?>

<div class="form">
<form id="add_members" method="post" action="" onSubmit="window.location.reload()">
<div class="left_column"><br>
		<h3>Member Information</h3><br>
		<div id="label-right-justify">
		
		<label for="mem_fname">Member #:</label>
		<input id="mem_number" required type="text" readonly="readonly" style="background-color: #C5C9CD" name="mem_number" value="<?php echo $data['mem_no'];?>"style="text-transform: capitalize;"><br><br>
		
		<label for="mem_fname">First Name:</label>
		<input id="mem_fname" required type="text" readonly="readonly" style="background-color: #C5C9CD" name="mem_fname" value="<?php echo $data['mem_fname'];?>"style="text-transform: capitalize;"><br><br>
		
		<label for="mname">Middle Name:</label>
		<input id="mname" type="text" name="mname" readonly="readonly" style="background-color: #C5C9CD" value="<?php echo $data['mem_mi'];?>" style="text-transform: capitalize;"><br><br>
				
		<label for="lname">Last Name:</label>
		<input id="lname" required type="text" readonly="readonly" style="background-color: #C5C9CD" name="lname" value="<?php echo $data['mem_lname'];?>" style="text-transform: capitalize;"><br><br>
		
		<label for="duty">Duty Phone:</label>
		<input id="duty" required type="tel" name="duty" placeholder="22x-xxxx" value="<?php echo $data['mem_duty_ph'];?>"><br><br>
				
		<label for="cell">Cell Number:</label>
		<input id="cell" type="tel" required type="text" name="cell" value="<?php echo $data['mem_cell_number'];?>" placeholder="000-0000-0000" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}"><br><br>
		
		<label for="street">Street:</label>
		<input id="street" required type="text" name="street" value="<?php echo $data['mem_add_street'];?>"><br><br>
		
		<label for="city">City:</label>
		<input id="city" required type="text" name="city" value="<?php echo $data['mem_add_city'];?>" autocomplete="on"><br><br>
		
		<label for="state">State:</label>
		<input id="state" required type="text" name="state" value="<?php echo $data['mem_add_state'];?>" autocomplete="on"><br><br>

		<label for="zip">Zip Code:</label>
		<input id="zip" required type="text" name="zip" value="<?php echo $data['mem_add_zip'];?>" autocomplete="on"><br><br>
		
		<label for="email">Email:</label>
		<input id="email" required type="email" name="email" value="<?php echo $data['mem_email'];?>"><br><br>
		
		<label for="installation">Installation:</label>
		<input id="installation" required type="text" style="background-color: #F3F2F2" name="installation" value="<?php echo $data['mem_installation'];?>"><br><br>
		
		<label for="remarks">Remarks:</label>
		<textarea id="remarks" name="remarks" style="height: 60px;"><?php echo $data['mem_remarks'];?></textarea><br><br>
		
		<label for="position">Position:</label>
		<input id="position" type="text" name="position" value="<?php echo $data['mem_position'];?>" style="text-transform: capitalize;"><br><br>
		
		<label for="category">Category:</label>
		<input id="category" style="background-color: #F3F2F2" required type="text" name="category" value="<?php echo $data['mem_category_cd'];?>"><br><br>
				
		<label for="memberType">Member Type:</label>
		<input id="memberType" style="background-color: #F3F2F2" required type="text" name="memberType" value="<?php echo $data['mem_type'];?>"><br><br>
		
</div>
</div>
<div class="right_column"><br>
		<h3>User Information</h3><br>
		<div id="label-right-justify1">
		<label for="username">Username:</label>
		<input id="username" required type="text" name="username" value="<?php echo $data['username'];?>"><br><br>
               			
        <label for="password">Password:</label>
        <input id="password" required name="password" type="text" value="<?php echo $data['password'];?>"><br><br>

        <label for="role">User Role:</label>
        <input id="role" required name="role" type="text" value="<?php echo $data['user_type'];?>"><br><br>
		</div>
		
		<h3>Family Member</h3><br>
		<div id="label-right-justify1">
		<label for="fam_mem_no">Family Member #: </label>
				<input id="fam_mem_no" readonly="readonly" style="background-color: #C5C9CD" type="text" style="background-color: #F3F2F2" name="fam_mem_no" value="<?php echo $data['fam_mem_no'];?>"><br><br>
				
				<label for="fam_fname">First Name: </label>
				<input id="fam_fname"  type="text" readonly="readonly" style="background-color: #C5C9CD" name="fam_fname" value="<?php echo $data['fam_fname'];?>"><br><br>
		            
				<label for="fam_mi">Middle Initial:</label>
		        <input id="fam_mi"  name="fam_mi" readonly="readonly" style="background-color: #C5C9CD" type="text" value="<?php echo $data['fam_mi'];?>"><br><br>

		        <label for="fam_lname">Last Name:</label>
		        <input id="fam_lname"  name="fam_lname" readonly="readonly" style="background-color: #C5C9CD" type="text" value="<?php echo $data['fam_lname'];?>"><br><br>

				<label for="fam_cell">Cell:</label>
				<input id="fam_cell"  readonly="readonly" style="background-color: #C5C9CD" name="fam_cell" type="tel" value="<?php echo $data['fam_cell_number'];?>"><br><br>

		        <label for="fam_email">Email:</label>
		        <input id="fam_email" readonly="readonly" style="background-color: #C5C9CD" name="fam_email" type="email" value="<?php echo $data['fam_email'];?>"><br><br>

		        <label for="fam_installation">Installation:</label>
				 <input id="fam_installation" readonly="readonly" style="background-color: #C5C9CD" name="fam_installation" type="text" value="<?php echo $data['fam_installation'];?>"><br><br>

	   </div>
		<h3>Membership</h3><br>
		<div id="label-right-justify1">
		<label for="eff-membership">Effective Date:</label>
		<input id="eff_membership" name="eff_membership" type="text" value="<?php echo $data['membership_eff_date'];?>"><br><br>
		
		<label for="term-membership">Termination Date:</label>
		<input id="term_membership" name="term_membership" type="text" value="<?php echo $data['membership_term_date'];?>"><br><br>
		
		<label for="memberAdded">Member Added:</label>
		<input id="memberAdded" readonly="readonly" style="background-color: #C5C9CD" required type="text" name="memberAdded" value="<?php echo $data['mem_add_date_time'];?>"><br><br>
		
		<label for="memberLastUpdated">Member Updated:</label>
		<input id="memberLastUpdated" readonly="readonly" style="background-color: #C5C9CD" required type="text" name="memberLastUpdated" value="<?php echo $data['mem_last_updated'];?>"><br><br>
		
		<label for="memberUpdatedBy">Last Updated By:</label>
		<input id="memberUpdatedBy" readonly="readonly" style="background-color: #C5C9CD" required type="tetxt" name="memberUpdatedBy" value="<?php echo $data['mem_updated_by'];?>"><br><br>

		</div>
	</div>
</div>
</div>
<div class="submit-inc-exp"><br>
<div id="bottom-return-to-dashboard">
<button type="submit" name="submit" class="submit-inc-exp">Submit</button><br><br><br><br>
<div id="button-back">
<a class="btn" href="admin_main_dashboard.php">Return to Dashboard</a>
</div>
</div>
</div>
</form>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<!-- Page footer; please do not change. Footer should always be on the bottom of the page but not fixed. -->
<footer>
<p>This site is intended for personal use by the members of the Yokota Sportsmen&#39;s Club specifically for conducting club business. All rights reserved. Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
</footer>
</body>
</html>
