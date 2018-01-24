<?php
	 
require 'database.php';
 
if ( !empty($_POST)) {
// keep track validation errors
		$mem_fnameError = null;
		$mem_lnameError = null;
		$mem_emailError = null;
		$mem_cell_numberError = null;
		$mem_typeError = null;
		 
// keep track post values
		$mem_fname = $_POST['mem_fname'];
		$mem_lname = $_POST['mem_lname'];
		$mem_email = $_POST['mem_email'];
		$mem_cell_number = $_POST['mem_cell_number'];
		$mem_type = $_POST['mem_type'];
		
// validate input
		$valid = true;
		if (empty($mem_fname)) {
			$fnameError = 'Please enter Name';
			$valid = false;
		}
		 
		$valid = true;
		if (empty($mem_lname)) {
			$lnameError = 'Please enter Name';
			$valid = false;
		}
		
		if (empty($mem_email)) {
			$emailError = 'Please enter Email Address';
			$valid = false;
			
		} else if ( !filter_var($mem_email,FILTER_VALIDATE_EMAIL) ) {
			$mem_emailError = 'Please enter a valid Email Address';
			$valid = false;
		}
		
		$valid = true;
		if (empty($mem_cell_number)) {
			$mem_cell_numberError = 'Please enter phone number';
			$valid = false;
		}

		$valid = true;
		if (empty($mem_type)) {
			$mem_typeError = 'Please select membership type';
			$valid = false;
		}
			 
// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO member (mem_fname,mem_lname,mem_email,mem_cell_number,mem_type) values(?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($mem_fname,$mem_lname,$mem_email,$mem_cell_number,$mem_type));
			Database::disconnect();
			header("Location: index.php");
		}
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
		<h3>Add a New Member</h3>
		</div>
 
<form class="form-horizontal" action="create.php" method="post">
	<div class="control-group <?php echo !empty($mem_fnameError)?'error':'';?>">
		<label class="control-label">First Name</label>
		<div class="controls">
				<input name="mem_fname" type="text"  placeholder="First Name" value="<?php echo !empty($mem_fname)?$mem_fname:'';?>">
				<?php if (!empty($mem_fnameError)): ?>
						<span class="help-inline"><?php echo $mem_fnameError;?></span>
				<?php endif; ?>
		</div>
	</div>
	
	<div class="control-group <?php echo !empty($mem_lnameError)?'error':'';?>">
		<label class="control-label">Last Name</label>
		<div class="controls">
				<input name="mem_lname" type="text"  placeholder="Last Name" value="<?php echo !empty($mem_lname)?$mem_lname:'';?>">
				<?php if (!empty($mem_lnameError)): ?>
						<span class="help-inline"><?php echo $mem_lnameError;?></span>
				<?php endif; ?>
		</div>
	</div>
	
	<div class="control-group <?php echo !empty($mem_emailError)?'error':'';?>">
		<label class="control-label">Email Address</label>
		<div class="controls">
				<input name="mem_email" type="text" placeholder="Email Address" value="<?php echo !empty($mem_email)?$mem_email:'';?>">
				<?php if (!empty($mem_emailError)): ?>
						<span class="help-inline"><?php echo $mem_emailError;?></span>
				<?php endif;?>
		</div>
	</div>
	
	<div class="control-group <?php echo !empty($mem_cell_numberError)?'error':'';?>">
		<label class="control-label">Phone Number</label>
		<div class="controls">
				<input name="mem_cell_number" type="text" placeholder="Phone Number" value="<?php echo !empty($mem_cell_number)?$mem_cell_number:'';?>">
				<?php if (!empty($mem_cell_numberError)): ?>
						<span class="help-inline"><?php echo $mem_cell_numberError;?></span>
				<?php endif;?>
		</div>
	</div>

	<div class="control-group <?php echo !empty($mem_typeError)?'error':'';?>">
		<label class="control-label">Membership Type (I or F)</label>
		<div class="controls">
				<input name="mem_type" type="text" placeholder="Membership Type" value="<?php echo !empty($mem_type)?$mem_type:'';?>">
				<?php if (!empty($mem_typeError)): ?>
						<span class="help-inline"><?php echo $mem_typeError;?></span>
				<?php endif;?>
		</div>
	</div>

	<div class="form-actions">
	<button type="submit" class="btn btn-success">Create</button>
	<a class="btn" href="index.php">Back</a>
	</div>
</form>
</div>
								 
</div> <!-- /container -->
</body>
</html>