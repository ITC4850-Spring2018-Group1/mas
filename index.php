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
		//$message = '<label>All fields are required.</label>';  
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
			header('Location: index.php?message=Invalid username and password combination');
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
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
 <style type="text/css">
 	.erreur{
		display:none;
		color:#F00;
		font-weight:bold;
	}
 </style> 
</head>  
<body>
<div class="logo">
	<img src="images/ysc1_logo.png" alt="logo">
</div>
<div class="logo2">
	<img src="images/american_japanese_flags.png" alt="flags">
</div>
<br>    
 <div class="container" style="width:500px;">  
	<?php  
if(isset($_GET['message']))  
	{  
			 echo '<label class="text-danger">'.$_GET['message'].'</label>';  
	}  
	?>
<br>
<br>
<div class="login">
<h3>Club Login Form</h3><br />
</div>  
<form method="post">  
	 <label>Username</label>  
	 <input type="text" name="username" id="username" class="form-control" />
     <p class="erreur" id="username-erreur">Please enter your username</p>  
	 <br />  
	 <label>Password</label>  
	 <input type="password" name="password" id="password" class="form-control" />
     <p class="erreur" id="password-erreur">Please enter your password</p>  
	 <br />  
	 <input type="submit" name="login" class="btn btn-info" value="Login" id="sub-form" /> 
	<br><br><br>
<p>Forgot your username or password? Click <a href="mailto:YSCsecretary@gmail.com">here</a>.</p>
<br>
<br>
<p><a href="https://www.facebook.com/yokotasportsmensclub/">About Us</a> &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;<a href="mailto:YSCsecretary@gmail.com">Contact Us</a></p>
</form>  
 </div>  
<br>
<br><br><br><br>
</div> 
<p id="login-page-message">Stay up-to-date with YSC events through email annoucements and newsletters! Click <a href="https://facebook.us17.list-manage.com/subscribe?u=38d1ab6fbfefeeab47f7bd995&id=56615443b8">here</a> to sign-up!</p>
<br>
<br>
<div id="social-media">
<!-- Add font-awesome icons -->
<a href="https://www.facebook.com/yokotasportsmensclub/" class="fa fa-facebook"></a>
<a href="#" class="fa fa-twitter"></a>
<a href="#" class="fa fa-pinterest"></a>
<a href="#" class="fa fa-youtube"></a>
</div>
<br>
<br>
<br>
<p id="message">Disclaimer: The information contained within this site is for demonstration purposes. If you have any questions about the content of this site, please message the project team <a href="mailto:kidder.r@husky.neu.edu">here.</a></p>
<footer>
<p>This site is intended for personal use by the members of the Yokota Sportsmen&#39;s Club specifically for conducting club business. All rights reserved. Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>

<script type="application/javascript">
	
	$( "#sub-form" ).on( "click", function(e) {
		if( ($( "#username" ).val() == "") || ($( "#password" ).val() == "") ){
			if( $( "#username" ).val() == "" ){
				$( "#username-erreur" ).show();
			}else{
				$( "#username-erreur" ).hide();
			}
			if( $( "#password" ).val() == "" ){
				$( "#password-erreur" ).show();
			}else{
				$( "#password-erreur" ).hide();
			}
			return false;
		}
		
	});
</script>
</body>
</html>
 
