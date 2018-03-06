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
?>
<!-- INSTRUCTIONS: this is the header and footer template for the primary USER pages. Code your forms, tables, etc., below the navigation tags. Placeholders have been included where variables will be displayed based on session login information for the user. Leave these "AS IS" for now. To maintain consistency, please do not change the header information other than where indicated with additional comments. -->

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
	<a href="logout.php">Sign Out</a>	
</div>

<div class="logininfo">
	<?php echo '<p>Welcome ' . $_SESSION["sess_username"].'! You are logged in as a MEMBER</p>'; ?> </div>
</div>
<br>
<br>
<br>
<br>
<!-- IMPORTANT #1: change the links to the pages in which users should be directed for YOUR specific wireframe as well as the text to display on the button -->
<div class="nav-user">
	<ul>
		<li><a href="user_view_edit_personal_information.php">View Profile</a></li>
		<li><a href="user_view_purchase_history.php">Purchase History</a></li>
		<li><a href="user_view_amounts_paid.php">Amounts Paid</a></li>
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
	<h3>ATF Status (View/Update)</h3>
</div>
<br>
<!-- IMPORTANT #3: insert/paste YOUR code below to create the table, form, etc. -->
<div class="main-body">
<center>
<table class="user-table"> 
	<thead>
		 <th>Date Added</th>
		 <th>Member ID</th>
		 <th>User Name</th> 
		 <th>Serial Number</th> 
		 <th>ATF Form Sent</th> 
		 <th>Date Sent</th> 
		 <th>Form Approved</th> 
		 <th>Comment</th> 
		 <th>Last Updated</th> 
		 <th>Updated By</th>
		 <th>Action</th> 
 	</thead>
<tbody>

<?php
 include 'database.php';
 $pdo = Database::connect();
 $username = $_SESSION["sess_username"];
 $sql = "SELECT * 
   FROM atf a
   LEFT JOIN users b ON a.atf_mem_no=b.user_mem_no
   WHERE b.username = '$username'
   ORDER BY atf_serial_no DESC";

foreach ($pdo->query($sql) as $row) {
				echo '<tr>';
				echo '<td>'. $row['atf_date_added'] . '</td>';
				echo '<td>'. $row['atf_mem_no'] . '</td>';
				echo '<td>'. $row['username'] . '</td>';
				echo '<td>'. $row['atf_serial_no'] . '</td>';
				echo '<td>'. $row['atf_status_cd'] . '</td>';
				echo '<td>'. $row['atf_form_sent_date'] . '</td>';
				echo '<td>'. $row['atf_form_approval_date'] . '</td>';
				echo '<td>'. $row['atf_comment'] . '</td>';
				echo '<td>'. $row['atf_last_updated'] . '</td>';
				echo '<td>'. $row['atf_updated_by'] . '</td>';
				echo '<td><a class="btn" href="">Update</a></td>';
				echo ' ';
				echo '</tr>';
 }
 Database::disconnect();
?>

</tbody>
</table>
</center> 
</div>
<br><br><br><br><br><br><br><br>
<div id="button-one">
<SCRIPT LANGUAGE="JavaScript"> 
	if (window.print) {
	document.write('<form><input type="button" name="print" value="Print Page"onClick="window.print()"></form>');
	}
</script>
</div>

<!-- Page footer; please do not change. Footer should always be on the bottom of the page but not fixed. -->
<footer>
<p>This site is intended for personal use by the members of the Yokota Sportsmen&#39;s Club specifically for conducting club business. All rights reserved. Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
