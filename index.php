<?php  
 session_start();  
 $host = "localhost";  
 $username = "root";  
 $password = "root";  
 $database = "yokotasp_mas1";  
 $message = "";  

try  {  
$connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);  
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
if(isset($_POST["login"]))  
{  
	 if(empty($_POST["username"]) || empty($_POST["password"]))  
	 {  
		$message = '<label>All fields are required.</label>';  
	 }  
	 else  
	 {  
		$query = "SELECT * 
		FROM users a
		LEFT JOIN ref_users_type b ON a.user_type=b.ref_users_type
		WHERE username = :username AND password = :password";  
		$statement = $connect->prepare($query);  
		$statement->execute(array('username'=>$_POST["username"],'password'=>$_POST["password"]));
		
		if ($statement->rowCount() == 0) {
			header('Location: index.php');
					}	
		else {
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			
			session_regenerate_id();
			$_SESSION['sess_user_id'] = $row['user_mem_no'];
			$_SESSION['sess_username'] = $row['username'];
			$_SESSION['sess_user_type'] = $row['user_type'];
			$_SESSION['sess_user_desc'] = $row['ref_users_desc'];
			echo $_SESSION['sess_userrole'];
			session_write_close();
			
			if( $_SESSION['sess_user_type'] == "A") {
				header('Location: admin_main_dashboard.php');
			  }
			else {
				header('Location: user_view_edit_personal_information.php');
			  }
		}
	  } 
}
  }  
 catch(PDOException $error)  
 {  
		$message = $error->getMessage();  
 }  

 ?>  
 <!DOCTYPE html>  
 <html>  
<head>  
 <title>Login | Membership and Accounting System</title>  
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
 <link rel="stylesheet" type="text/css" href="css/new_master_stylesheet.css">
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
</head>  
<body>  
<div class="main-heading">
	<h1>Yokota Sportsmen&#39;s Club</h1>
</div>

<br />  
 <div class="container" style="width:500px;">  
	<?php  
	if(isset($message))  
	{  
			 echo '<label class="text-danger">'.$message.'</label>';  
	}  
	?>
<br>
<br>
<div class="login">
<h3>Club Login Form</h3><br />
</div>  
<form method="post">  
	 <label>Username</label>  
	 <input type="text" name="username" class="form-control" />  
	 <br />  
	 <label>Password</label>  
	 <input type="password" name="password" class="form-control" />  
	 <br />  
	 <input type="submit" name="login" class="btn btn-info" value="Login" /> 
	<br><br>
<p>Forgot your username or password? Click <a href="mailto:YSCsecretary@gmail.com">here</a>.</p>
<br>
<br>
<p><a href="https://www.facebook.com/yokotasportsmensclub/">About Us</a> &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;<a href="mailto:YSCsecretary@gmail.com">Contact Us</a></p>
</form>  
 </div>  
 <br />  
<footer>
<p>This site is intended for personal use by the members of the Yokota Sportsmen&#39;s Club specifically for conducting club business. All rights reserved. Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
</body>
</html>