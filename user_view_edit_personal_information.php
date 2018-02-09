<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/main.css">
<title>Member Accounting System</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<body>
<div class="header">
	<div class="headertitle"><p>Yakota Sportsmen's Club</p>
	</div>
	<div class="memberinfo"> 
		<p>Welcome <a href="fname" fname>ref[fname]</a>,<a href="lname" lname>ref[lname]</a> you are logged in as a _____		<button type="signout">Sign Out</button>
		</p>		
	</div>
	<div class="navbox">
		<form>
			<input class="MyButton" type="button" value="Amounts Paid" onclick="window.location.href='http://www.hyperlinkcode.com/button-links.php'"/>
			<input class="MyButton" type="button" value="ATF Status" onclick="window.location.href='http://www.hyperlinkcode.com/button-links.php'"/>
			<input class="MyButton" type="button" value="Purchase History" onclick="window.location.href='http://www.hyperlinkcode.com/button-links.php'"/>
		
	</form>
	</div>
</div>
<br>
<hr />
<div class="wrapper">
	
	<div class="formbox">
		<h1 class="formheader">Membership and Accounting System</h1>
		<h2 class="formheader">Profile/Personal Informaton</h2>
		<div class="row">
			<div class="column">
			<form action="/user_membership_page.php">
				First Name <input type="text" name=fname" value="">
				<br>
				Middle Name <input type="text" name=lname" value="">
				<br>
				Last Name <input type="text" name=fname" value="">
				<br>
				Duty Phone <input type="text" name=lname" value="">
				<br>
				Cell Number <input type="text" name=fname" value="">
				<br>
				Street <input type="text" name=lname" value="">
				<br>
				City <input type="text" name=fname" value="">
				<br>
				State <input type="text" name=lname" value="">
				<br>
				Zip Code <input type="text" name=fname" value="">
				<br>
				Email <input type="text" name=lname" value="">
				<br>
				Installation <input type="text" name=fname" value="">
				<br>
				Remarks <input type="text" name=lname" value="">
				<br>
				Position <input type="text" name=fname" value="">
				<br>
				Add Date Time <input type="text" name=lname" value="">
				<br>
				Last Update <input type="text" name=fname" value="">
				<br>
				Updated By <input type="text" name=lname" value="">
				<br>
			</form>
			</div>
			<div class="column">
			<form action="/user_membership_page.php">
				Family Member # <input type="text" name=fname" value="">
				<br>
				First Name      <input type="text" name=lname" value="">
				<br>
				Middle Name     <input type="text" name=fname" value="">
				<br>
				Last Name       <input type="text" name=lname" value="">
				<br>
				Cell Number     <input type="text" name=fname" value="">
				<br>
				Email           <input type="text" name=lname" value="">
				<br>
				Installation    <input type="text" name=fname" value="">
				<br>
				Remarks      <input type="text" name=lname" value="">
				<br>
			</form>
			</div>
		</div>
		<br><br>
		<div class="bottombuttons">
		<button type="coolbutton">Save</button>
		<button type="coolbutton">Clear</button>
	</div>
	</div>
</div>
<div class="footer">
		<footer>
			<hr />
			<div class="copyright">
				<p>This site is intended for personal use by the members of the Yokota Sportsmen’s Club specifically for conducting club business. <br>All rights reserved. Yokota Sportsmen’s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
			<p>Copyright &copy; 2018</p>
			</div>
			</footer>
</div>
</body>
	
</html>