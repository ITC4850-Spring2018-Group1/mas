<!-- INSTRUCTIONS: this is the header and footer template for the primary ADMIN pages. Code your forms, tables, etc., below the navigation tags. Placeholders have been included where variables will be displayed based on session login information for the user. Leave these "AS IS" for now. To maintain consistency, please do not change the header information other than where indicated with additional comments. -->

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
	<p>[placeholder][placeholder] you are logged in as an ADMIN</p>
</div>
<br>
<br>
<br>
<br>
<!-- IMPORTANT #1: change the links to the pages in which users should be directed for YOUR specific wireframe as well as the text to display on the button -->
<div class="nav-admin">
	<ul>
		<li><a href="admin_add_new_members.php">Add Membership</a></li>
		<li><a href="admin_view_update_membership_summary.php">View Membership</a></li>
		<li><a href="admin_view_update_ATF_status.php">View ATF Status</a></li>
		<li><a href="admin_post_sales_checkout.php">Post Sales/Checkout</a></li>
		<li><a href="admin_view_general_ledger.php">View General Ledger</a></li>
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
	<h3>View/Update Price list</h3>
</div>
<br>


<!-- IMPORTANT #3: insert/paste YOUR code below to create the table, form, etc. -->

<table class="user-table"> 
	<thead>
		 <th><a href="admin_view_update_import_price_list.php?sort=id">List #</a></th> 
		 <th><a href="admin_view_update_import_price_list.php?sort=date">Item #</th> 
		 <th>Receipt #</th> 
	 	 <th><a href="admin_view_update_import_price_list.php?sort=mem_no">Serial #</th> 
		 <th>Manu</th> 
		 <th>Mod</th> 
		 <th>kind</th> 
		 <th>Typ</th> 
		 <th>Gge</th> 
		 <th>Bbl</th> 
		 <th>Chk</th> 
		 <th>Qty</th> 
		 <th>Price (Y)</th> 
		 <th>Desc</th>
		 <th>Comment</th>
		 <th>Add date</th>
		 <th>Update date</th>
		 <th>Action</th>
		 
 	</thead>

<tbody>

</tbody>
</table>
<br><br><br><br><br><br>
<!-- Page footer; please do not change. Footer should always be on the bottom of the page but not fixed. -->
<footer>
<p>This site is intended for personal use by the members of the Yokota Sportsmen&#39;s Club specifically for conducting club business. All rights reserved. Yokota Sportsmen&#39;s Club, Fussa-shi, Tokyo, Japan | Yokota Air Base, Tokyo, Japan</p>
