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
	<title>Membership and Accounting System (MAS)</title>
	<link rel="stylesheet" type="text/css" href="css/new_master_stylesheet.css">
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/jqueryui/dataTables.jqueryui.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/jquery.dataTables.js"></script>

<link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/jquery.dataTables_themeroller.css" rel="stylesheet" data-semver="1.9.4" data-require="datatables@*" />
<link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/jquery.dataTables.css" rel="stylesheet" data-semver="1.9.4" data-require="datatables@*" />
<link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/demo_table_jui.css" rel="stylesheet" data-semver="1.9.4" data-require="datatables@*" />
<link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/demo_table.css" rel="stylesheet" data-semver="1.9.4" data-require="datatables@*" />
<link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/demo_page.css" rel="stylesheet" data-semver="1.9.4" data-require="datatables@*" />
<link data-require="jqueryui@*" data-semver="1.10.0" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/css/smoothness/jquery-ui-1.10.0.custom.min.css" />
<link href="style.css" rel="stylesheet" />
<script src="script_test.js"></script>

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
		<li><a href="admin_view_update_membership_summary.php">View Membership</a></li>
		<li><a href="admin_add_new_members.php">Add Membership</a></li>
		<li><a href="admin_view_general_ledger.php">View General Ledger</a></li>
		<li><a href="admin_post_income_expenses.php">Post Income/Expenses</a></li>
		<li><a href="admin_post_sales_checkout.php">Post Sales/Checkout</a></li>
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
	<h3>View/Update ATF Status</h3>
</div><br>


<!-- IMPORTANT #3: insert/paste YOUR code below to create the table, form, etc. -->
<center>

<table class="user-table" id="datatable"> 
	<thead> 
		 <th>Member<br>#</th> 
		 <th>First Name</th> 
		 <th>MI</th> 
		 <th>Last Name</th> 
		 <th>Serial #</th> 
		 <th>ATF Form<br>Sent</th> 
         <th>Sent Date</th>
         <th>Approval Date</th>
         <th>Comment</th>
         <th>Date Added</th>
         <th>Last Updated</th>
         <th>Updated By</th>
         <th>Action</th>
 	</thead>

	<tfoot>
		<th>Member<br>#</th> 
		 <th>First Name</th> 
		 <th>MI</th> 
		 <th>Last Name</th> 
		 <th>Serial #</th> 
		 <th>ATF Form<br>Sent</th> 
	  	 <th>Sent Date</th>
		 <th>Approval Date</th>
		 <th>Comment</th>
		 <th>Date Added</th>
		 <th>Last Updated</th>
		 <th>Updated By</th>
		 <th>Action</th>
	</tfoot>

<tbody>

<?php
 include 'database.php';
 $pdo = Database::connect();
 $sql = 'SELECT * 
FROM atf a
LEFT JOIN price_list b ON a.atf_serial_no=b.pri_li_serial_no
LEFT JOIN member c ON a.atf_mem_no=c.mem_no';

foreach ($pdo->query($sql) as $row) {
	echo '<tr>';
	echo '<td>'. $row['mem_no'] . '</td>';
	echo '<td>'. $row['mem_fname'] . '</td>';
	echo '<td>'. $row['mem_mi'] . '</td>';
	echo '<td>'. $row['mem_lname'] . '</td>';
	echo '<td>'. $row['atf_serial_no'] . '</td>';
	echo '<td>'. $row['atf_status_cd'] . '</td>';
	echo '<td>'. $row['atf_form_sent_date'] . '</td>';
	echo '<td>'. $row['atf_form_approval_date'] . '</td>';
	echo '<td>'. $row['atf_comment'] . '</td>';
	echo '<td>'. $row['atf_date_added'] . '</td>';
	echo '<td>'. $row['atf_last_updated'] . '</td>';
	echo '<td>'. $row['atf_updated_by'] . '</td>';
	echo '<td><a href="admin_view_update_ATF_details.php?serial_no='.$row['atf_serial_no'].'" target="_blank">View | Update</a></td>';
	echo ' ';
	echo '</tr>';
 }
 Database::disconnect();
?>
</table>
<br><br><br><br><br><br>
<div id="button-two">
	<ul>
		 <li><a href="admin_view_update_import_price_list.php">View Inventory</a></li>
		 <li><a href="admin_main_dashboard.php">Return to Dashboard</a></li>
	</ul>
</div><br><br><br> 
<div id="button-one">
<SCRIPT LANGUAGE="JavaScript"> 
	if (window.print) {
	document.write('<form><input type="button" name="print" value="Print Report"onClick="window.print()"></form>');
	}
</script>
</div>
<br><br><br>
<!-- Page footer; please do not change. Footer should always be on the bottom of the page but not fixed. -->
<footer>
<p>This site is intended for personal use by the members of the Yokota Sportsmen&#39;s Club specifically for conducting club business. All rights reserved. Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
</body>
</html>