<!DOCTYPE HTML>  
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="js/bootstrap.min.js"></script>
<style>

</style>
</head>
<body>  
<h1>Membership and Accounting System</h1>

<div class="menu">
	<ul>
		<li><a href="index.php" <?php if( $page == 'index') echo 'class="active"'?> >Home</a></li>
		</div>

<h2>View Current Membership</h2>
<div class="container">
		<div class="row">
	<table class="table table-striped table-bordered">
			<thead>
			<tr>
			<th>ID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email Address</th>
			<th>Phone Number</th>
			<th>Description</th>
			<th>Add Date</th>
			</tr>
			</thead>
		<tbody>
		
<!-- /use PHP to connect to the database using the database.php file -->			
<?php
include 'database.php';
	$pdo = Database::connect();
	$sql = 
	'SELECT * 
	FROM member a
	LEFT JOIN ref_member_type b ON a.mem_type = b.ref_mem_typ
	ORDER BY mem_no DESC';
	
	foreach ($pdo->query($sql) as $row) {
			echo '<tr>';
			echo '<td>'. $row['mem_no'] . '</td>';
			echo '<td>'. $row['mem_fname'] . '</td>';
			echo '<td>'. $row['mem_lname'] . '</td>';
			echo '<td>'. $row['mem_email'] . '</td>';
			echo '<td>'. $row['mem_cell_number'] . '</td>';
			echo '<td>'. $row['ref_mem_typ_desc'] . '</td>';
			echo '<td>'. $row['mem_add_date_time'] . '</td>';
			echo '</tr>';
								 }
Database::disconnect();
?>
			</tbody>
	</table>
</div>
	</div> <!-- /container -->
<br>
<a href="create.php" <?php if( $page == 'create') echo 'class="active"'?> >Create a New Member</a><br>
<a class="btn" href="index.php">Back</a>

</body>
</html>