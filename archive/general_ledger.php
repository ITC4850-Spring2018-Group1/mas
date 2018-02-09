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
<div class="container">
<div class="row">
		<h3>View General Ledger</h3>
</div>
<div class="row">
		<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Transaction Date</th>
							<th>Receipt Number</th>
							<th>Description</th>
							<th>Type</th>
							<th>Sign</th>
							<th>Amount</th>
							<th>Expense Type</th>
							<th>Income Type</th>
							<th>Balance</th>
							<th>Added by</th>
						</tr>
					</thead>
					<tbody>
<?php
 include 'database.php';
 $pdo = Database::connect();
 $sql = 'SELECT * 
FROM general_ledger a
LEFT JOIN balance b ON a.gen_led_id=b.bal_gen_led_id
LEFT JOIN receipts c ON a.gen_led_id=c.rec_gen_led_id
ORDER BY gen_led_id DESC';

 foreach ($pdo->query($sql) as $row) {
					echo '<tr>';
					echo '<td>'. $row['gen_led_id'] . '</td>';
					echo '<td>'. $row['gen_led_trans_date'] . '</td>';
					echo '<td>'. $row['rec_receipt_no'] . '</td>';
					echo '<td>'. $row['gen_led_description'] . '</td>';
					echo '<td>'. $row['gen_led_transaction_type'] . '</td>';
					echo '<td>'. $row['gen_led_transaction_sign'] . '</td>';
					echo '<td>'. $row['gen_led_amount'] . '</td>';
					echo '<td>'. $row['gen_led_expense_type'] . '</td>';
					echo '<td>'. $row['gen_led_income_type'] . '</td>';
					echo '<td>'. $row['bal_acct_balance'] . '</td>';
					echo '<td>'. $row['gen_led_add_by'] . '</td>';
					echo '</tr>';
 }
 Database::disconnect();
?>
					</tbody>
		</table>
</div>
</div> <!-- /container -->
<h2>View Extended Membership Information</h2>
<li><a href="view.php" <?php if( $page == 'view') echo 'class="active"'?> >View</a></li>


</body>
</html>