<?php
		require 'database.php';
		$mem_no = null;
		if ( !empty($_GET['mem_no'])) {
				$mem_no = $_REQUEST['mem_no'];
		}
		 
		if ( null==$mem_no ) {
				header("Location: index.php");
		} else {
				$pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "SELECT * FROM member where mem_no = ?";
				$q = $pdo->prepare($sql);
				$q->execute(array($mem_no));
				$data = $q->fetch(PDO::FETCH_ASSOC);
				Database::disconnect();
		}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="js/bootstrap.min.js"></script>
</head>
 
<body>
<div class="container">
		 
<div class="span10 offset1">
		<div class="row">
				<h3>Read Customer Details</h3>
		</div>
		 
		<div class="form-horizontal" >
			<div class="control-group">
				<label class="control-label">Last Name</label>
				<div class="controls">
						<label class="checkbox">
								<?php echo $data['mem_lname'];?>
						</label>
				</div><br>
			</div>
			<div class="control-group">
				<label class="control-label">Email Address</label>
				<div class="controls">
						<label class="checkbox">
								<?php echo $data['mem_email'];?>
						</label>
				</div><br>
			</div>
			<div class="control-group">
				<label class="control-label">Cell Number</label>
				<div class="controls">
						<label class="checkbox">
								<?php echo $data['mem_cell_number'];?>
						</label>
				</div><br><br>
			</div>
				<div class="form-actions">
					<a class="btn" href="index.php">Back</a>
			 </div>
		 
			
</div>
</div>
								 
		</div> <!-- /container -->
	</body>
</html>