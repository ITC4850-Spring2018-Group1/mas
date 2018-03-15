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
	<?php echo '<p>Welcome ' . $_SESSION["sess_username"].'! You are logged in as a MEMBER</p>'; ?> 
</div>
<br>
<br>
<br>
<br>
<!-- IMPORTANT #1: change the links to the pages in which users should be directed for YOUR specific wireframe as well as the text to display on the button -->
<div class="nav-user">
	<ul>
		<li><a href="user_view_edit_personal_information.php">View Profile</a></li>
		<li><a href="user_view_amounts_paid.php">Amounts Paid</a></li>
		<li><a href="user_view_update_ATF_status.php">ATF Status</a></li>
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
	<h3>Purchase History from Inventory</h3>
</div>
<br>
<!-- IMPORTANT #3: insert/paste YOUR code below to create the table, form, etc. -->

<center>
	<table class="user-table"> 
	<thead>
		 <th>Purchase Date/Time</th>
		 <th>Member Number</th>
		 <th>User Name</th>
		 <th>Serial Number</th> 
		 <th>Manufacturer</th> 
		 <th>Model</th> 
		 <th>Kind</th> 
		 <th>Type</th> 
		 <th>Gauge</th> 
		 <th>List Price (&yen;)</th> 
		 <th>Description</th> 
 	</thead>
<tbody>

<?php
require 'database.php';
 $pdo = Database::connect();
 $username = $_SESSION["sess_username"];
 $sql = "SELECT * 
   FROM price_list a
   LEFT JOIN atf b ON a.pri_li_serial_no=b.atf_serial_no
   LEFT JOIN users c ON b.atf_mem_no=c.user_mem_no
   LEFT JOIN general_ledger d ON a.pri_li_serial_no=d.gen_led_description
   LEFT JOIN receipts e ON e.rec_gen_led_id=d.gen_led_id
   WHERE (username = '$username')";

foreach ($pdo->query($sql) as $row) {
					echo '<tr>';
					echo '<td>'. $row['rec_date_time'] . '</td>';
					echo '<td>'. $row['atf_mem_no'] . '</td>';
					echo '<td>'. $row['username'] . '</td>';
					echo '<td>'. $row['pri_li_serial_no'] . '</td>';
					echo '<td>'. $row['pri_li_manufacturer'] . '</td>';
					echo '<td>'. $row['pri_li_model'] . '</td>';
					echo '<td>'. $row['pri_li_kind'] . '</td>';
					echo '<td>'. $row['pri_li_type'] . '</td>';
					echo '<td>'. $row['pri_li_gauge'] . '</td>';
					echo '<td>'. $row['pri_li_price'] . '</td>';
					echo '<td>'. $row['pri_li_description'] . '</td>';
					echo ' ';
					echo '</tr>';
 }

 Database::disconnect();
?>
</tbody>
</table>
</center> 
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
