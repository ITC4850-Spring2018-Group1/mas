<!-- INSTRUCTIONS: this is the header and footer template for the primary USER pages. Code your forms, tables, etc., below the navigation tags. Placeholders have been included where variables will be displayed based on session login information for the user. Leave these "AS IS" for now. To maintain consistency, please do not change the header information other than where indicated with additional comments. -->

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
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
	<a href="signout.php">Sign Out</a>	
</div>

<div class="logininfo">
	<p>[placeholder][placeholder] you are logged in as an MEMBER</p>
</div>
<br>
<br>
<br>
<br>
<!-- IMPORTANT #1: change the links to the pages in which users should be directed for YOUR specific wireframe as well as the text to display on the button -->
<div class="nav-user">
	<ul>
		<li><a href="admin_add_new_members.php">View Profile</a></li>
		<li><a href="admin_post_income_expenses.php">Purchase History</a></li>
		<li><a href="admin_view_update_ATF_status.php">ATF Status</a></li>
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
	<h3>User View and Edit Personal Information</h3>
</div>
<!-- IMPORTANT #3: insert/paste YOUR code below to create the table, form, etc. -->

<div class="formbox">
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





<!-- Page footer; please do not change. Footer should always be on the bottom of the page but not fixed. -->
<footer>
<p>This site is intended for personal use by the members of the Yokota Sportsmen&#39;s Club specifically for conducting club business. All rights reserved. Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
