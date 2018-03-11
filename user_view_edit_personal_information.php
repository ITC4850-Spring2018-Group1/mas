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

?>
<!-- INSTRUCTIONS: this is the header and footer template for the primary USER pages. Code your forms, tables, etc., below the navigation tags. Placeholders have been included where variables will be displayed based on session login information for the user. Leave these "AS IS" for now. To maintain consistency, please do not change the header information other than where indicated with additional comments. -->

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="css/chris_stylesheet.css">
	<title>Membership and Accounting System (MAS)</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<div class="main-heading">
	<h1>Yokota Sportsmen&#39;s Club</h1>
</div>

<!-- this redirects the user to a signout page where the variables will be reset and the session terminated -->
<div class="signout">
	<a href="logout.php">Sign Out</a>	
</div>

<div class="logininfo">
	<?php echo '<p>Welcome ' . $_SESSION["sess_username"].'! You are logged in as a MEMBER</p>'; ?> 
</div>
<br>
<br>
<br>
<br>
<!-- IMPORTANT #1: change the links to the pages in which users should be directed for YOUR specific wireframe as well as the text to display on the button -->
<div class="nav-user">
	<ul>
		<li><a href="user_view_amounts_paid.php">View Profile</a></li>
		<li><a href="user_view_purchase_history.php">Purchase History</a></li>
		<li><a href="user_view_update_ATF_status.php">ATF Status</a></li>
	</ul>
<br>
</div>
<hr>
<br>
<div class="main-title">
<h2>Membership and Accounting System</h2>
</div>
<!-- IMPORTANT #2: change the H3 tag to match the title of YOUR specific wireframe -->
<div class="individual-page-title">	
	<h3>User View and Edit Personal Information</h3>
</div>
<!-- IMPORTANT #3: insert/paste YOUR code below to create the table, form, etc. -->

<div class="formbox">
	<div class="row">
		<div class="column">
			<form style="margin: 0px;" action="/user_membership_page.php">
				<label for="firstname">First Name</label>
				<input id="first-name" type="text" name="fname">

				<label for="middlename">Middle Name</label>
				<input id="middle-name" type="text" name="fname" value="">
				
				<label for="lastame">Last Name</label>
				<input id="last-name" type="text" name="fname" value="">
				
				<label for="dutyphone">Duty Phone</label>
				<input id="duty-phone" type="text" name="fname" value="">
				
				<label for="cellnumber">Cell Number</label>
				<input id="cellnumber" type="text" name="fname" value="">
				
				<label for="street">Street</label>
				<input id="street" type="text" name="fname" value="">
				
				<label for="city">City</label>
				<input id="city" type="text" name="fname" value="">
				
				<label for="state">State</label>
				<input id="state" type="text" name="fname" value="">

				<label for="zipcode">Zip Code</label>
				<input id="zipcode" type="text" name="fname" value="">
				
				<label for="email">Email</label>
				<input id="email" type="email" name="fname" value="">
				
				<label for="installation">Installation</label>
				<input id=" installation" type="text" name="fname" value="">
				
				<label for="remarks">Remarks</label>
				<textarea name="message" style="width: 50%; max-width:50%; height: 90px;"></textarea>
				
				<label for="position">Position</label>
				<input id="position" type="text" name="fname" value="">

				<label for="adddatetime">Add Date Time</label>
				<input id="adddatetime" type="text" name="fname" value="">
				
				<label for="lastupdated">Last Updated</label>
				<input id="lastupdated" type="text" name="fname" value="">

				<label for="updatedby">Updated by</label>
				<input id="updatedby" type="text" name="fname" value="">
			</form>
			</div>
			<div class="column">
			<form style="margin: 0px;" action="/user_membership_page.php">
				<label for="familymember">Family Member #</label>
				<input type="text" name="fname" value="">

				<label for="firstname">First Name</label>
				<input id="first-name" type="text" name="fname">

				<label for="middlename">Middle Name</label>
				<input id="middle-name" type="text" name="fname" value="">
				
				<label for="lastame">Last Name</label>
				<input id="last-name" type="text" name="fname" value="">


				<label for="cellnumber">Cell Number</label>
				<input id="cellnumber" type="text" name="fname" value="">
				
				<label for="email">Email</label>
				<input id="email" type="email" name="fname" value="">
				
				<label for="installation">Installation</label>
				<input id=" installation" type="text" name="fname" value="">
				
				<label for="remarks">Remarks</label>
				<textarea name="message" style="width: 50%; max-width:50%; height: 90px;"></textarea>
				
			</form>
			</div>
		</div>
		<br><br>
		<div class="bottombuttons">
			<button type="coolbutton">Save</button>
			<button type="coolbutton">Clear</button>
			<br>
		</div>
	</div>
</div>
<br><br>




<!-- Page footer; please do not change. Footer should always be on the bottom of the page but not fixed. -->
<footer>
<p>This site is intended for personal use by the members of the Yokota Sportsmen&#39;s Club specifically for conducting club business. All rights reserved. Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
</footer>
</body>
</html>