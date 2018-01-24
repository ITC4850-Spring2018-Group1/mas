<!DOCTYPE HTML>  
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="js/bootstrap.min.js"></script>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  
<h1>Membership and Accounting System</h1>
<div class="menu">
	<ul>
		<li><a href="index.php" <?php if( $page == 'index') echo 'class="active"'?> >Index</a></li>
		<li><a href="view.php" <?php if( $page == 'view') echo 'class="active"'?> >View</a></li>
		<li><a href="add.php" <?php if( $page == 'about') echo 'class="active"'?> >Add</a></li>	</ul>
</div>

<?php
	class TableRows extends RecursiveIteratorIterator { 
		function __construct($it) { 
			parent::__construct($it, self::LEAVES_ONLY); 
		}

		function current() {
			return "<td style='width:90px;border:1px solid black;'>" . parent::current(). "</td>";
		}

		function beginChildren() { 
			echo "<tr>"; 
		} 

		function endChildren() { 
			echo "</tr>" . "\n";
		} 
	} 

// define variables and set to empty values
$fnameErr = $lnameErr = $emailErr = $typeErr = "";
$fname = $lname = $email = $type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["fname"])) {
		$fnameErr = "First name is required";
	} else {
		$fname = test_input($_POST["fname"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
			$fnameErr = "Only letters and white space allowed"; 
		}
	}
	
	if (empty($_POST["lname"])) {
		$lnameErr = "Last name is required";
	} else {
		$lname = test_input($_POST["lname"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
			$lnameErr = "Only letters and white space allowed"; 
		}
	}
	
	if (empty($_POST["email"])) {
		$emailErr = "Email is required";
	} else {
		$email = test_input($_POST["email"]);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format"; 
		}
	}

	if (empty($_POST["type"])) {
		$typeErr = "type is required";
	} else {
		$type = test_input($_POST["type"]);
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>

<h2>Add New Membership</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
	First Name: <input type="text" name="fname">
	<span class="error">* <?php echo $fnameErr;?></span>
	<br><br>
	Last Name: <input type="text" name="lname">
	<span class="error">* <?php echo $lnameErr;?></span>
	<br><br>
	E-mail: <input type="text" name="email">
	<span class="error">* <?php echo $emailErr;?></span>
	<br><br>
	Member Type (I/F):
	<input type="radio" name="type" value="Individual">Individual
	<input type="radio" name="type" value="Family">Family
	<span class="error">* <?php echo $typeErr;?></span>
	<br><br>
	<input type="submit" name="submit" value="Submit">
</form>

<?php
echo "<h2>Your Information Confirmed:</h2>";
echo $fname . " ". $lname;
echo "<br>";
echo $email;
echo "<br>";
echo $type;
?>

</body>
</html>
