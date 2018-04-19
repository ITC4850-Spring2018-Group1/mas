<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "root", "test");
$columns = array('gen_led_id','gen_led_trans_date','rec_receipt_no','mem_no','mem_fname', 'mem_lname', 'gen_led_description','ref_gen_led_transaction_desc','gen_led_amount','ref_gen_led_expense_desc','ref_gen_led_income_desc','bla_acct_balance','gen_led_add_by');

$query = "SELECT * FROM general_ledger a
LEFT JOIN balance b ON a.gen_led_id=b.bal_gen_led_id
LEFT JOIN receipts c ON a.gen_led_id=c.rec_gen_led_id
LEFT JOIN ref_gen_led_expense_type d ON a.gen_led_expense_type=d.ref_gen_led_expense_typ
LEFT JOIN ref_gen_led_transaction_type e ON a.gen_led_transaction_type=e.ref_gen_led_transaction_typ
LEFT JOIN ref_gen_led_income_type f ON a.gen_led_income_type=f.ref_gen_led_income_typ
LEFT JOIN member g ON a.gen_led_users_mem_no=g.mem_no
LEFT JOIN balance h ON a.gen_led_id=h.bal_gen_led_id
LEFT JOIN users i ON a.gen_led_add_by=i.user_mem_no
WHERE ";

if($_POST["is_date_search"] == "yes")
{
 $query .= 'gen_led_trans_date LIKE "'.$_POST["start_date"].'%" AND "'.$_POST["end_date"].'%" AND ';
}

//if(isset($_POST["search"]["value"]))
//{
// $query .= '
//	(order_id LIKE "%'.$_POST["search"]["value"].'%" 
//	OR order_customer_name LIKE "%'.$_POST["search"]["value"].'%" 
//	OR order_item LIKE "%'.$_POST["search"]["value"].'%" 
//	OR order_value LIKE "%'.$_POST["search"]["value"].'%")
// ';
//}

//if(isset($_POST["order"]))
//{
// $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
// ';
//}
//else
//{
// $query .= 'ORDER BY order_id DESC ';
//}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = $row["order_id"];
 $sub_array[] = $row["order_customer_name"];
 $sub_array[] = $row["order_item"];
 $sub_array[] = $row["order_value"];
 $sub_array[] = $row["order_date"];
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM general_ledger a
LEFT JOIN balance b ON a.gen_led_id=b.bal_gen_led_id
LEFT JOIN receipts c ON a.gen_led_id=c.rec_gen_led_id
LEFT JOIN ref_gen_led_expense_type d ON a.gen_led_expense_type=d.ref_gen_led_expense_typ
LEFT JOIN ref_gen_led_transaction_type e ON a.gen_led_transaction_type=e.ref_gen_led_transaction_typ
LEFT JOIN ref_gen_led_income_type f ON a.gen_led_income_type=f.ref_gen_led_income_typ
LEFT JOIN member g ON a.gen_led_users_mem_no=g.mem_no
LEFT JOIN balance h ON a.gen_led_id=h.bal_gen_led_id
LEFT JOIN users i ON a.gen_led_add_by=i.user_mem_no";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>
