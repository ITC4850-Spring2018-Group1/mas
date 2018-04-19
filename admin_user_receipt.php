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
			
require 'database.php';
$rec_receipt_no = null;
if ( !empty($_GET['rec_receipt_no'])) {
		$rec_receipt_no = $_REQUEST['rec_receipt_no'];
}
 
if ( null==$rec_receipt_no ) {
		header("Location: index.php");
} 

else {
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * 
FROM receipts a
LEFT JOIN general_ledger b ON a.rec_gen_led_id=b.gen_led_id
LEFT JOIN member c ON b.gen_led_users_mem_no=c.mem_no
WHERE rec_receipt_no = ?";
$q = $pdo->prepare($sql);
$q->execute(array($rec_receipt_no));
$data = $q->fetch(PDO::FETCH_ASSOC);
Database::disconnect();
}
?>

<!-- INSTRUCTIONS: this is the header and footer template for the primary USER pages. Code your forms, tables, etc., below the navigation tags. Placeholders have been included where variables will be displayed based on session login information for the user. Leave these "AS IS" for now. To maintain consistency, please do not change the header information other than where indicated with additional comments. -->

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	<link rel="stylesheet" type="text/css" href="css/new_master_stylesheet.css">
	<title>Membership and Accounting System (MAS)</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<div class="logo-admin">
	<img src="images/ysc2_logo.png" alt="logo">
</div>

<div class="logininfo">
	<?php echo '<p>Welcome ' . $_SESSION["sess_username"].'! You are logged in as an ADMIN</p>'; ?> 
</div>
<!-- this redirects the user to a signout page where the variables will be reset and the session terminated -->
<br>
<div class="ReceiptDate">
	<?php
echo date("Y/m/d");
?>	
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<!-- IMPORTANT #2: change the H3 tag to match the title of YOUR specific wireframe -->
<div class="individual-page-title">	
	<h3>Receipt</h3>
</div><br><br>
<label class="receipt-label">Member #:</label>
<label class="receipt-info">
	<?php echo $data['mem_no'];?>
</label><br><br>

<label class="receipt-label">Member First Name:</label>
<label class="receipt-info">
	<?php echo $data['mem_fname'];?><br>
</label><br><br>

<label class="receipt-label">Member Last Name:</label>
<label class="receipt-info">
	<?php echo $data['mem_lname'];?>
</label><br><br>

<label class="receipt-label">Installation:</label>
<label class="receipt-info">
	<?php echo $data['mem_installation'];?>
</label><br><br>

<label class="receipt-label">Street Address:</label>
<label class="receipt-info">
	<?php echo $data['mem_add_street'];?><br>
	<?php echo $data['mem_add_city'];?>
	<?php echo $data['mem_add_state'];?>
	<?php echo $data['mem_add_zip'];?>
</label>


<!-- IMPORTANT #3: insert/paste YOUR code below to create the table, form, etc. -->
<br><br>
<table class="user-table"> 
	<thead>
		 <th>Transaction<br>Date/Time</th> 
		 <th>General<br>Ledger <br> ID</th> 
		 <th>Receipt #</th> 
		 <th>Description</th> 
		 <th>Transaction</th> 
		 <th>Income Type</th> 
		 <th>Expense Type</th> 
		 <th>Serial #</th> 
		 <th>Amount<br>($)</th> 
		 <th>Received By</th>
	 </thead>
<tbody>
<br>

<?php
 $sql = "SELECT * 
FROM general_ledger a
LEFT JOIN receipts b ON a.gen_led_id=b.rec_gen_led_id
LEFT JOIN ref_gen_led_transaction_type c ON a.gen_led_transaction_type=c.ref_gen_led_transaction_typ
LEFT JOIN ref_gen_led_expense_type d ON a.gen_led_expense_type=d.ref_gen_led_expense_typ
LEFT JOIN ref_gen_led_income_type e ON a.gen_led_income_type=e.ref_gen_led_income_typ
LEFT JOIN atf f ON a.gen_led_id=f.atf_gen_led_id
LEFT JOIN price_list g ON f.atf_serial_no=g.pri_li_serial_no
WHERE rec_receipt_no = $rec_receipt_no
ORDER BY gen_led_id DESC";

foreach ($pdo->query($sql) as $row) {
					echo '<tr>';
					echo '<td>'. $row['gen_led_trans_date'] . '</td>';
					echo '<td>'. $row['gen_led_id'] . '</td>';
					echo '<td>'. $row['rec_receipt_no'] . '</td>';
					echo '<td>'. $row['gen_led_description'] . '</td>';
					echo '<td>'. $row['ref_gen_led_transaction_desc'] . '</td>';
					echo '<td>'. $row['ref_gen_led_income_desc'] . '</td>';
					echo '<td>'. $row['ref_gen_led_expense_desc'] . '</td>';
					echo '<td>'. $row['pri_li_serial_no'] . '</td>';
					echo '<td>$'. $row['gen_led_amount'] . '</td>';
					echo '<td>'. $row['gen_led_add_by'] . '</td>';
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
	document.write('<form><input type="button" name="print" value="Print Receipt"onClick="window.print()"></form>');
	}
</script>
</div><br><br>
<div class="back">
<ul>
<li><button onclick="goBack()">Go Back</button></li>
<script>
function goBack() {
	window.history.back();
}
</script>
</ul>
</div>
<!-- Page footer; please do not change. Footer should always be on the bottom of the page but not fixed. -->
<footer>
<p>Copyright 2018 Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
</body>
</html>
