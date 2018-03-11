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

<!-- INSTRUCTIONS: this is the header and footer template for the primary ADMIN pages. Code your forms, tables, etc., below the navigation tags. Placeholders have been included where variables will be displayed based on session login information for the user. Leave these "AS IS" for now. To maintain consistency, please do not change the header information other than where indicated with additional comments. -->

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
	<a href="signout.php">Sign Out</a>	
</div>

<div class="logininfo">
	<p>[placeholder][placeholder] you are logged in as an ADMIN</p>
</div>
<br>
<br>
<br>
<br>
<!-- IMPORTANT #1: change the links to the pages in which users should be directed for YOUR specific wireframe as well as the text to display on the button -->
<div class="nav-admin">
	<ul>
		<li><a href="admin_view_update_membership_summary.php">View Membership</a></li>
		<li><a href="admin_view_general_ledger.php">View General Ledger</a></li>
		<li><a href="admin_view_update_ATF_status.php">ATF Status</a></li>
		<li><a href="admin_view_update_import_price_list.php">Import Inventory</a></li>
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
	<h3>Membership Expiry Report</h3>
</div><br>


<!-- IMPORTANT #3: insert/paste YOUR code below to create the table, form, etc. -->
<center>

<table class="user-table"> 
	<thead> 
		 <th>M. no.</th> 
		 <th>First Name</th> 
		 <th>MI</th> 
		 <th>Last Name</th> 
		 <th>Member Category</th> 
                 <th>Member Type</th> 
		 <th>Effective Date</th> 
                 <th>Term Date</th> 
	      
 	</thead>

<tbody>

<?php
 include 'database.php';
 $pdo = Database::connect();
 $sql = 'SELECT * 
FROM member a
LEFT JOIN Membership b ON a.mem_no=b.membership_no
LEFT JOIN ref_member_catg c ON a.mem_category_cd=c.ref_mem_category_cd
LEFT JOIN ref_member_type d ON a.mem_type=d.ref_mem_typ';


foreach ($pdo->query($sql) as $row) {
					echo '<tr>';
					echo '<td>'. $row['mem_no'] . '</td>';
					echo '<td>'. $row['mem_fname'] . '</td>';
					echo '<td>'. $row['mem_mi'] . '</td>';
					echo '<td>'. $row['mem_lname'] . '</td>';
					echo '<td>'. $row['ref_mem_category_desc'] . '</td>';
					echo '<td>'. $row['ref_mem_typ_desc'] . '</td>';
					echo '<td>'. $row['membership_eff_date'] . '</td>';
					echo '<td>'. $row['membership_term_date'] . '</td>';
					echo ' ';
					echo '</tr>';
 }
 Database::disconnect();
?>
</table>
<br><br><br><br><br><br>
<div id="button">
	<ul>
		 <li><a href="admin_report_member_expiry.php">Print</a></li>
		 <li><a href="admin_main_dashboard.php">Return to Dashboard</a></li>
	</ul>
</div>
<br><br><br>
<!-- Page footer; please do not change. Footer should always be on the bottom of the page but not fixed. -->
<footer>
<p>This site is intended for personal use by the members of the Yokota Sportsmen&#39;s Club specifically for conducting club business. All rights reserved. Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
</body>
</html>
