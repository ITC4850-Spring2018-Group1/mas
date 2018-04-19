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


<p id="message">This application is currently under construction. Information shown is for the purposes of testing.</p>


<div class="container">
<div class="row">
<h3>View Current Membership</h3>
</div>
<div class="row">
		<p>
		<a href="create.php" class="btn btn-success">Add a New Member</a>&nbsp;&nbsp;&nbsp;&nbsp;
		</p>
		<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					
<?php
 include 'database.php';
 $pdo = Database::connect();
 $sql = 'SELECT * FROM member ORDER BY mem_no DESC';
 foreach ($pdo->query($sql) as $row) {
					echo '<tr>';
					echo '<td>'. $row['mem_no'] . '</td>';
					echo '<td>'. $row['mem_fname'] . '</td>';
					echo '<td>'. $row['mem_lname'] . '</td>';
					echo '<td>'. $row['mem_email'] . '</td>';
					echo '<td width=150>';
					echo '<a class="btn" href="read.php?mem_no='.$row['mem_no'].'">Read</a>';
					echo ' ';
					echo '<a class="btn btn-success" href="update.php?mem_no='.$row['mem_no'].'">Update</a>';
					echo ' ';
					echo '<a class="btn btn-danger" href="delete.php?mem_no='.$row['mem_no'].'">Delete</a>';
					echo '</td>';
					echo '</tr>';
 }
 Database::disconnect();
?>
					</tbody>
		</table>
</div>
</div> <!-- /container -->
<h2>View General Ledger</h2>
<li><a href="general_ledger.php" <?php if( $page == 'view') echo 'class="active"'?> >View</a></li>


</body>
</html>