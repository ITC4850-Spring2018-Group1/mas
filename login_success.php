<?php  
 //login_success.php  
 session_start();  
 if(isset($_SESSION["sess_username"]))  
 {  
	echo '<h3>Login Success, Welcome - '.$_SESSION["sess_username"].'</h3>';  
	echo '<br /><br /><a href="logout.php">Logout</a>';  
 }  
 else  
 {  
	header("location:index.php");  
 }  
 ?>  