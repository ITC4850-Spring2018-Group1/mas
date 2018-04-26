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

<?php
require 'database.php';
if(isset($_POST['mem_no'])) 
{
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$mem_no = $_POST['mem_no'];
	$trans_type = $_POST['trans_type'];
	$income_type = $_POST['income_type'];
	$expense_type = $_POST['expense_type'];
	$amount = $_POST['amount'];
	$description = $_POST['description'];
	$username = $_SESSION["sess_username"];
	
	$q = "INSERT INTO general_ledger (gen_led_users_mem_no, gen_led_transaction_type, gen_led_expense_type, gen_led_income_type, gen_led_amount, gen_led_description, gen_led_add_by) VALUES (:mem_no, :trans_type, :expense_type, :income_type, :amount, :description, '$username')";
	$q2 = "INSERT INTO balance (bal_gen_led_id, bal_trans_type, bal_trans_amount) VALUES ((LAST_INSERT_ID()), '$trans_type', '$amount')";
	$q3 = "INSERT INTO receipts (rec_gen_led_id) VALUES (LAST_INSERT_ID())";
	
	$query = $pdo->prepare($q);
	$query2 = $pdo->prepare($q2);
	$query3 = $pdo->prepare($q3);
	
	$result = $query->execute(array(
	   ":mem_no" => $mem_no,
	   ":trans_type" => $trans_type,
	   ":expense_type" => $expense_type,
	   ":income_type" => $income_type,
	   ":amount" => $amount,
	   ":description" => $description
));
	$result1 = $query2->execute();
	$result2 = $query3->execute();
	
	if($result){ //if the update worked
		if($result1) {
			if($result2) {
				echo "<p id=message>Update successful!</p>";	 
			}
		}
	}
	
	Database::disconnect();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="css/new_master_stylesheet.css">
	<link rel="shortcut icon" type="image/png" href="/images/favicon-16x16.png"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
	<title>Membership and Accounting System (MAS)</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script type="application/javascript" >
	$(function() {

	//if ($('#trans-type').val() == "") 
	$('#trans-amount').prop('disabled',true);

    $('#trans-type').on('change', function() {
     // after creating the option
   
	    if ($('#trans-type').val() == "I") {
	    	$('#expense-type').prop('disabled',true);
	    	$('#income-type').removeAttr('disabled');
	    	$('#trans-amount').removeAttr('disabled');
	    }

	    if ($('#trans-type').val() == "E") {
	    	$('#income-type').prop('disabled',true);
	    	$('#expense-type').removeAttr('disabled');
	    	$('#trans-amount').removeAttr('disabled');
	    }
	});

	 $("form").submit(function(e) {
	   console.log(!!$('#trans-amount').val());
	   if (!$('#trans-amount').val()) {
	   		alert("transaction amount required");
	   		return false;
	   }

	   if (($('#trans-type').val() == "I" && !!$('#income-type').val()) || ($('#trans-type').val() == "E" && !!$('#expense-type').val())) 
	   { 
	    //alert('successful validation, submit for realz');

	     return true;
	   } 
	   else {
	   	alert('rejected');
	   	return false;
	   }
})

   if ($('#trans-type').val() == "I") {
    	$('#expense-type').prop('disabled',true);
    	$('#income-type').removeAttr('disabled');
		$('#income-type').prop('required',true);
    }

    if ($('#trans-type').val() == "E") {
    	$('#income-type').prop('disabled',true);
    	$('#expense-type').removeAttr('disabled');
    }

   // try following
   //$("select").prop('disabled',true);
   //alert($('#trans-type').val());

});

</script>


</head>

<body>
<div class="logo-admin">
	<img src="images/ysc2_logo.png" alt="logo">
</div>

<!-- this redirects the user to a signout page where the variables will be reset and the session terminated -->
<div class="signout1">
	<a href="logout.php">Sign Out</a>	
</div>

<div class="logininfo1">
	<?php echo '<p>Welcome ' . $_SESSION["sess_username"].'! You are logged in as an ADMIN</p>'; ?> 
</div>
<br>
<br>
<br>
<br>
<!-- IMPORTANT #1: change the links to the pages in which users should be directed for YOUR specific wireframe as well as the text to display on the button -->
<div class="nav-admin">
	<ul>
		<li><a href="admin_add_new_members.php">Add Membership</a></li>
		<li><a href="admin_view_update_membership_summary.php">View Membership</a></li>
		<li><a href="admin_view_general_ledger.php">View General Ledger</a></li>
		<li><a href="admin_view_update_ATF_status.php">View ATF Status</a></li>
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
	<h3>Post Income/Expenses (Non-Sales)</h3>
</div>
<br>
<!-- IMPORTANT #3: insert/paste YOUR code below to create the table, form, etc. -->
<div id="search-by">
<h4>Search for Member by Name:</h4>
</div><br>

<form action="" name="myForm" method="post">
<div class="select-name">
	<label>Member Name:</label>
		<select required name="mem_no" class="required">
			<option value=""></option>
			<?php
				require_once 'start.php';
				$usersQuery = "SELECT mem_no, mem_lname, mem_fname FROM member ORDER BY mem_lname";
				$users = $db->query($usersQuery);
			?>
			<?php foreach($users->fetchAll() as $user): ?>
				<option value="<?php echo $user['mem_no']; ?>"><?php echo $user['mem_lname']; ?><?php echo ", "; ?><?php echo $user['mem_fname']; ?></option>
			<?php endforeach; 
			Database::disconnect();?>		
		</select>
</div><br>

<div class="select-trans">
	<label>Transaction Type:</label>
	<select required name="trans_type" id="trans-type">
		<option disabled selected value> -- select an option -- </option>
		<option value="I">Income</option>
		<option value="E">Expense</option>
	</select>
</div><br>

<div class="select-exp-type">
	<label>Expense Type:</label>
	<select required name="expense_type" id="expense-type">
		<option disabled selected value> -- select an option -- </option>
		<option value="M">E - Meeting</option>
		<option value="T">E - Trip Reimbursement</option>
		<option value="O">E - Other</option>
		<option value="S">E - Supplies</option>
		<option value="X">E - Clerical Error</option>
		<option value="R">E - Sales fee refund</option>
	</select>
</div><br>

<div class="select-inc-type">
	<label>Income Type:</label>
	<select required name="income_type" id="income-type">
		<option disabled selected value> -- select an option -- </option>
		<option value="AD">I - Annual Dues</option>
		<option value="RD">I - Renewal Dues</option>
		<option value="FD">I - Fundraiser</option>
		<option value="DO">I - Donation</option>
		<option value="OO">I - Other</option>
		<option value="IN">I - Interest Payment</option>
		<option value="CE">I - Clerical Error</option>
	</select>
</div><br>


<div class="amount">
	<label>Amount ($):</label>
	<input type="number" name="amount" id="trans-amount" min="0.00" step="0.01" placeholder="00.00">
</div><br>

<div class="description">
	<label>Description:</label>
	<textarea type="text" rows="4" cols="20" wrap="soft" name="description"></textarea>
</div>
<br>
<div class="submit-inc-exp"><br>
	<button type="submit" id="sub-form" name="submit" class="submit-inc-exp">Submit</button><br><br><br><br>
	<div id="bottom-return-to-dashboard">
	<div id="button-back">
	<a class="btn" href="admin_main_dashboard.php">Return to Dashboard</a>
	</div>
	</div>

	</div>
	
<div class="reset">
	<button type="reset" value="Reset">Reset</button>
</div>

</form>


<!-- Page footer; please do not change. Footer should always be on the bottom of the page but not fixed. -->
<footer>
<p>This site is intended for personal use by the members of the Yokota Sportsmen&#39;s Club specifically for conducting club business. All rights reserved. Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
</body>
</html>