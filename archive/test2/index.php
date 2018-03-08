<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script>

<form action="index.php" method="get">
From : <input type="text" name="d1" class="tcal" value="" /> 
To: <input type="text" name="d2" class="tcal" value="" /> 
<input type="submit" value="Search">
</form>

<table id="resultTable" data-responsive="table" style="text-align: left; width: 400px;" border="1" cellspacing="0" cellpadding="4">
<thead>
	<tr>
		<th> Birthday </th>
		<th> Name </th>
		<th> Gender </th>
	</tr>
</thead>
<tbody>

<?php
include('connect.php');
if (isset($_GET["d1"])) { $d1  = $_GET["d1"]; } else { $d1=0; }; 
if (isset($_GET["d2"])) { $d2  = $_GET["d2"]; } else { $d2=0; }; 
$result = $db->prepare("SELECT * FROM birthday WHERE date BETWEEN :a AND :b");
$result->bindParam(':a', $d1);
$result->bindParam(':b', $d2);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
?>
<tr class="record">
<td><?php echo $row['date']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['gender']; ?></td>
</tr>
<?php
}
?>
</tbody>
</table>