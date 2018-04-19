<?php
if(isset($_POST['submit'])) {
	
	$serial = $_POST['hidden'];
	$status = $_POST['status'];
	
	$update = $con->prepare("UPDATE atf SET atf_status_cd = $status WHERE atf_serial_no = $serial");
	$result = $update->execute();
	
	if($result)
	{
		echo "<script type='text/javascript'>alert('ATF information has been updated.');
		</script>";
	}
	else
	{
		echo "<script type= 'text/javascript'>alert('Information has not been updated. Please verify submission.');<///script>";
	}
}		

?>