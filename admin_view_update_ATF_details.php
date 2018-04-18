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
			$serial_no = null;
			if ( !empty($_GET['serial_no'])) {
					$serial_no = $_REQUEST['serial_no'];
			}
			 
			if ( null==$serial_no ) {
					header("Location: index.php");
			} 

			else {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM atf WHERE atf_serial_no = '$serial_no'";
			$q = $pdo->prepare($sql);
			$q->execute(array($serial_no));
			$data = $q->fetch(PDO::FETCH_ASSOC);
			Database::disconnect();
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
	
	<script>
	window.resizeTo(920, 600);
	</script>
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
	<?php echo '<p>Welcome ' . $_SESSION["sess_username"].'! You are logged in as an ADMIN</p>'; ?> 
</div>
<br>
<br>
<br>
<br>
<!-- IMPORTANT #1: change the links to the pages in which users should be directed for YOUR specific wireframe as well as the text to display on the button -->
<hr>
<br>
<div class="main-title">
<h2>MEMBERSHIP AND ACCOUNTING SYSTEM</h2>
</div>
<!-- IMPORTANT #2: change the H3 tag to match the title of YOUR specific wireframe -->
<div class="individual-page-title">	
	<h3>Update ATF Status / Information</h3>
</div>
<!-- IMPORTANT #3: insert/paste YOUR code below to create the table, form, etc. -->
<?php
	if(isset($_POST['submit'])){ //if the submit button is clicked
	$status = $_POST['status_cd'];
	$sentDate = $_POST['sent_date'];
	$apprDate = $_POST['appr_date'];
	$comment = $_POST['comment'];
	$atf_updated_by = $_SESSION['sess_username'];
	
	$update = "UPDATE atf SET atf_status_cd = '$status', atf_form_sent_date = '$sentDate', atf_form_approval_date = '$apprDate', atf_comment = '$comment', atf_updated_by = '$atf_updated_by' WHERE atf_serial_no = '$serial_no'";
	
	$query = $pdo->prepare($update);
	$result = $query->execute();
		
	if($update){//if the update worked
		echo "<font color='red'><b>Update successful!</b></font>";	}  
}
?>

<br>
<form id="update_ATF" method="post" action="">
<label for="serial_no">Serial #:</label>
<input id="serial_no" required type="text" readonly="readonly" style="background-color: #C5C9CD" name="serial_no" value="<?php echo $data['atf_serial_no'];?>"><br><br>

<label for="status_cd">Status Code:</label>
<input id="status_cd" type="text" name="status_cd" value="<?php echo $data['atf_status_cd'];?>"><br><br>

<label for="sent_date">Form Sent Date:</label>
<input id="sent_date" type="text" name="sent_date" value="<?php echo $data['atf_form_sent_date'];?>"><br><br>

<label for="appr_date">Form Approval Date:</label>
<input id="appr_date" type="text" name="appr_date" value="<?php echo $data['atf_form_approval_date'];?>"><br><br>

<label for="comment">Form Approval Date:</label>
<input id="comment" type="text" name="comment" value="<?php echo $data['atf_comment'];?>"><br><br>
<br>
<button type="submit" name="submit" class="submit-inc-exp">Submit</button><br><br><br><br>

</form>

<!-- Page footer; please do not change. Footer should always be on the bottom of the page but not fixed. -->
<footer>
<p>This site is intended for personal use by the members of the Yokota Sportsmen&#39;s Club specifically for conducting club business. All rights reserved. Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
</body>
</html>
