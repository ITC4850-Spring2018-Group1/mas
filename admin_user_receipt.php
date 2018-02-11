<!-- INSTRUCTIONS: this is the header and footer template for the primary USER pages. Code your forms, tables, etc., below the navigation tags. Placeholders have been included where variables will be displayed based on session login information for the user. Leave these "AS IS" for now. To maintain consistency, please do not change the header information other than where indicated with additional comments. -->

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
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
	<?php
echo date("Y/m/d");
?>	
</div>
<br>
<br>
<br>
<br>

<hr>
<br>
<!-- IMPORTANT #2: change the H3 tag to match the title of YOUR specific wireframe -->
<div class="individual-page-title">	
	<h3>Receipt</h3>
</div>
<div class="wrapper">
<div class="formbox">
		<div class="row">
			<div class="column">
			<form action="/user_membership_page.php">
				Member#: <input type="text" name=fname" value="">
				<br>
				Member First Name: <input type="text" name=lname" value="">
				<br>
				Member Last Name: <input type="text" name=fname" value="">
				<br>
				Street: <input type="text" name=lname" value="">
				<br>
				Installation <input type="text" name=fname" value="">
				<br>
			</form>
			</div>
		</div>
	</div>
</div>
<br>
<!-- IMPORTANT #3: insert/paste YOUR code below to create the table, form, etc. -->

<center>
	<table class="user-table"> 
	<thead>
		 <th>Transaction Date</th> 
		 <th>Receipt #</th> 
		 <th>Description</th> 
		 <th>Transaction</th> 
		 <th>Income Type</th> 
		 <th>Expense Type</th> 
		 <th>Serial #</th> 
		 <th>Amount</th> 
		 <th>Received By</th>
 	</thead>
<tbody>

<?php
 include 'database.php';
 $pdo = Database::connect();
 $sql = 'SELECT * 
FROM atf
ORDER BY atf_serial_no DESC';

foreach ($pdo->query($sql) as $row) {
					echo '<tr>';
					echo '<td>'. $row['atf_serial_no'] . '</td>';
					echo '<td>'. $row['atf_status_cd'] . '</td>';
					echo '<td>'. $row['atf_form_sent_date'] . '</td>';
					echo '<td>'. $row['atf_form_approval_date'] . '</td>';
					echo '<td>'. $row['atf_comment'] . '</td>';
					echo '<td>'. $row['atf_date_added'] . '</td>';
					echo '<td>'. $row['atf_last_updated'] . '</td>';
					echo '<td>'. $row['atf_updated_by'] . '</td>';
					echo '<td>'. $row['atf_updated_by'] . '</td>';
					echo ' ';
					echo '</tr>';
 }
 Database::disconnect();
?>
<tbody>
</center> 

<!-- Page footer; please do not change. Footer should always be on the bottom of the page but not fixed. -->
<footer>
<p>Copyright 2018 Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
