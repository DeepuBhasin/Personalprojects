<?php
//including the database connection file
include_once("config.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM patient ORDER BY id DESC"); // using mysqli_query instead
?>

<html>
<head>	
	<title>Homepage</title>
</head>

<body>
<a href="add.html">Add New Data</a><br/><br/>

	<table width='80%' border="3" cellspacing="1" cellpadding="7">

	<tr bgcolor='#CCCCCC'>
		<td>Sri No</td>
		<td>Name</td>
		<td>Age</td>
		<td>Phone</td>
		<td>Email</td>
		<td>Update</td>
	</tr>
	<?php 
	$c=0;
	while($res = mysqli_fetch_array($result)) { 		
		echo "<tr>";
		echo "<td>".++$c."</td>";
		echo "<td>".$res['name']."</td>";
		echo "<td>".$res['age']."</td>";
		echo "<td>".$res['phone_number']."</td>";
		echo "<td>".$res['email']."</td>";	
		echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
	}
	?>
	</table>
</body>
</html>
