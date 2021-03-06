<br>
<?php  
session_start();
if(isset($_SESSION["sess_username"]))  
 {  
	echo '<h6>Your session is currently ACTIVE '.$_SESSION["sess_username"].'</h6><br>';    
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
if(isset($_POST['submit'])) {
	try {
		$pdoConnect = new PDO("mysql:host=localhost;dbname=yokotasp_mas1","root","root");
		} 
		catch (PDOException $exc) {
			echo $exc->getMessage();
			exit();
	}
	
// get values from input text and number
	$fname = ucwords($_POST['mem_fname']);
	$mi = ucwords($_POST['mname']);
	$lname = ucwords($_POST['lname']);
	$duty = $_POST['duty'];
	$cell = $_POST['cell'];
	$street = $_POST['street'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];
	$email = $_POST['email'];
	$installation = $_POST['installation'];
	$remarks = $_POST['remarks'];
	$category = $_POST['category'];
	$memberType = $_POST['memberType'];
	$position = ucwords($_POST['position']);
	$sess_username = $_SESSION["sess_username"];
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$role = $_POST['role'];
	
	$fam_fname = ucwords($_POST['fam_fname']);
	$fam_mi = ucwords($_POST['fam_mi']);
	$fam_lname = ucwords($_POST['fam_lname']);
	$fam_cell = $_POST['fam_cell'];
	$fam_email = $_POST['fam_email'];
	$fam_installation = $_POST['installation'];
	$fam_remarks = $_POST['fam_remarks'];
	
	$eff_membership = $_POST['eff-membership'];
	$term_membership = $_POST['term-membership'];

// mysql query to insert data
$pdoQuery = "INSERT INTO member (mem_fname, mem_mi, mem_lname, mem_duty_ph, mem_cell_number, mem_add_street, mem_add_city, mem_add_state, mem_add_zip, mem_email, mem_installation, mem_category_cd, mem_type, mem_remarks, mem_position, mem_updated_by) VALUES(:fname, :mi, :lname, :duty, :cell, :street, :city, :state, :zip, :email, :installation, :category, :role, :remarks, :position, '$sess_username')";

$pdoQuery2 = "INSERT INTO users (user_mem_no, user_type, username, password) VALUES ((LAST_INSERT_ID()), :role, :username, :password)";

$pdoQuery4 = "INSERT INTO membership (membership_no, membership_eff_date, membership_term_date) VALUES ((LAST_INSERT_ID()), :effdate, :termdate)";

// mysql prepare queries
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoResult1 = $pdoConnect->prepare($pdoQuery2);
$pdoResult3 = $pdoConnect->prepare($pdoQuery4);

// mysql execute queries
$pdoExec = $pdoResult->execute(array(":fname"=>$fname,":mi"=>$mi,":lname"=>$lname,":duty"=>$duty,":cell"=>$cell,":street"=>$street,":city"=>$city,":state"=>$state,":zip"=>$zip,":email"=>$email,":installation"=>$installation,":remarks"=>$remarks,":category"=>$category,":role"=>$memberType,":position"=>$position));

$pdoExec2 = $pdoResult1->execute(array(":role"=>$role,":username"=>$username,"password"=>$password));

$pdoExec4 = $pdoResult3->execute(array(":effdate"=>$eff_membership, ":termdate"=>$term_membership));

// if family member names are BOTH empty; if one or the other is present, post a message; otherwise, if both are present, enter a family member record
if(empty($fam_fname) || empty($fam_lname)) {
	
}
else {
	$pdoQuery3 = "INSERT INTO family (fam_fname, fam_mi, fam_lname, fam_cell_number, fam_email, fam_installation, fam_remarks, fam_assoc_mem_no) VALUES (:f_fname, :f_mi, :f_lname, :f_cell, :f_email, :f_install, :f_remarks, (LAST_INSERT_ID()))";

	$pdoResult2 = $pdoConnect->prepare($pdoQuery3);

	$pdoExec3 = $pdoResult2->execute(array(":f_fname"=>$fam_fname,":f_mi"=>$fam_mi,":f_lname"=>$fam_lname,":f_cell"=>$fam_cell,":f_email"=>$fam_email,":f_install"=>$fam_installation,":f_remarks"=>$fam_remarks));
	
}

// check if mysql insert query successful
	if($pdoExec){ //if the update worked
		if($pdoExec2) {
			if($pdoExec4) {
				echo "<p id=message>Member has been added successfully!</p>";
				}	 
			}
		}
		
	  if($pdoExec3) {
		echo "<p id=message2>Family information has been added successfully!</p>";
	}
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
<div class="logo-admin">
	<img src="images/ysc3_logo.png" alt="logo">
</div>

<!-- this redirects the user to a signout page where the variables will be reset and the session terminated -->
<div class="signout1">
	<a href="logout.php">Sign Out</a>	
</div>

<div class="logininfo1">
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
		<li><a href="admin_view_update_membership_summary.php">View Membership</a></li>
		<li><a href="admin_view_general_ledger.php">View General Ledger</a></li>
		<li><a href="admin_view_update_ATF_status.php">View ATF Status</a></li>
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
	<h3>Add New Members</h3>
</div>
<!-- IMPORTANT #3: insert/paste YOUR code below to create the table, form, etc. -->
<div class="form">
<form id="add_members" method="post" action="">
<div class="left_column"><br>
		<h3>Member Information</h3><br>
		<div id="label-right-justify">
		<label for="mem_fname">First Name:</label>
		<input id="mem_fname" required type="text" name="mem_fname" value="" style="text-transform: capitalize;"><br><br>
		
		<label for="mname">Middle Initial:</label>
		<input id="mname" type="text" name="mname" value="" style="text-transform: capitalize;"><br><br>
				
		<label for="lname">Last Name:</label>
		<input id="lname" required type="text" name="lname" value="" style="text-transform: capitalize;"><br><br>
		
		<label for="duty">Duty Phone:</label>
		<input id="duty" required type="tel" name="duty" placeholder="22x-xxxx" value="225-"><br><br>
				
		<label for="cell">Cell Number:</label>
		<input id="cell" type="tel" required type="text" name="cell" value="" placeholder="000-0000-0000" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}"><br><br>
		
		<label for="street">Street:</label>
		<input id="street" required type="text" name="street" value="PSC 78 Box"><br><br>
		
		<label for="city">City:</label>
		<input id="city" required type="text" name="city" value="APO" autocomplete="on"><br><br>
		
		<label for="state">State:</label>
		<input id="state" required type="text" name="state" value="AP" autocomplete="on"><br><br>

		<label for="zip">Zip Code:</label>
		<input id="zip" required type="text" name="zip" value="96326" autocomplete="on"><br><br>
		
		<label for="email">Email:</label>
		<input id="email" required type="email" name="email" value=""><br><br>
		
		<label for="installation">Installation:</label>
		<select required name="installation" type="text">
			<option value=""></option>
			<option value="Yokota">Yokota</option>
			<option value="Zama">Zama</option>
			<option value="Yokosuka">Yokosuka</option>
			<option value="Other">Other</option>
		</select><br><br>
		
		<label for="remarks">Remarks:</label>
		<textarea name="remarks" style="height: 60px;"></textarea><br><br>
		
		<label for="position">Position:</label>
		<input id="position" type="text" name="position" value="" style="text-transform: capitalize;"><br><br>
		
		<label for="category">Category:</label>
		<select required name="category" type="text">
			<option value=""></option>
			<option value="AD">Active Duty</option>
			<option value="AD">Civilian</option>
			<option value="LN">Local National</option>
			<option value="AD">Advisor</option>
		</select><br><br>
		
		<label for="memberType">Member Type:</label>
		<select required name="memberType" type="text">
			<option value=""></option>
			<option value="I">Individual</option>
			<option value="F">Family</option>
		</select><br><br>
		</div>
</div>
<div class="right_column"><br>
		<h3>User Information</h3><br>
		<div id="label-right-justify1">
		<label for="username">Username:</label>
		<input id="username" required type="text" name="username" value=""><br><br>
               			
        <label for="password">Password:</label>
        <input id="password" required name="password" type="text"><br><br>

        <label for="role">User Role:</label>
        <select required name="role" id="role" type="text" value="U">
			<option value=""></option>
			<option value="U">User</option>
			<option value="A">Admin</option>
		 </select><br><br><br>
		</div>
		<h3>Family Member</h3><br>
		<div id="label-right-justify1">
		<label for="fam_fname">First Name: </label>
		<input id="fam_fname" type="text" name="fam_fname" style="text-transform: capitalize;"><br><br>
            
		<label for="fam_mi">Middle Initial:</label>
        <input id="fam_mi" name="fam_mi" type="text" style="text-transform: capitalize;"><br><br>

        <label for="fam_lname">Last Name:</label>
        <input id="fam_lname" name="fam_lname" type="text" style="text-transform: capitalize;"><br><br>

		<label for="fam_email">Cell:</label>
		<input id="fam_cell" name="fam_cell" type="tel"><br><br>

        <label for="fam_email">Email:</label>
        <input id="fam_email" name="fam_email" type="email"><br><br>

        <label for="fam_installation">Installation:</label>
		<select name="fam_installation" id="fam_installation "type="text">
			<option value=""></option>
			<option value="Yokota">Yokota</option>
			<option value="Zama">Zama</option>
			<option value="Yokosuka">Yokosuka</option>
			<option value="Other">Other</option>
		</select><br><br>

       <label for="fam_remarks">Remarks:</label>
       <textarea name="fam_remarks" id="fam_remarks" style="height: 60px;"></textarea><br><br>
	   </div><br>
		<h3>Membership</h3><br>
		<div id="label-right-justify1">
		<label for="eff-membership">Effective Date:</label>
		<select name="eff-membership" required id="eff-membership "type="text">
			<option value=""></option>
			<option value="2016/10/01">2016/10/01</option>
			<option value="2017/10/01">2017/10/01</option>
			<option value="2018/10/01">2018/10/01</option>
		</select><br><br>
		
		<label for="term-membership">Termination Date:</label>
		<select name="term-membership" required id="term-membership "type="text">
			<option value=""></option>
			<option value="2017/09/30">2017/09/30</option>
			<option value="2018/09/30">2018/09/30</option>
			<option value="2019/09/30">2019/09/30</option>
		</select><br><br>
		</div>
	   </div>
</div>
</div>
<div id="button5">
<input id="submit" type="submit" name="submit" value="Add Member" style="width:200px;height:45px;";>
<input id="reset" type="reset" name="reset" value="Clear" style="width:200px;height:45px;";>
</div>
</form>
<br>
<br>
<div id="bottom-return-to-dashboard">
<div id="button-back">
<a class="btn" href="admin_main_dashboard.php">Return to Dashboard</a>
</div>
</div>
</div>
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























