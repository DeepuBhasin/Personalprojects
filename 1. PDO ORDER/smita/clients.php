<h1>Current Guests</h1>

<?php
	$conn = mysqli_connect("localhost", "c1059188", "abc123", "c1059188_db3");

	$sql = "SELECT * FROM users";

	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			
			echo "<table><thead><tr>";
			echo "<th>No.</th>";
			echo "<th colspan='2' >Full Name</th>";
			echo "<th>Email</th>";
			echo "<th colspan='2'>Action</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tr>";
			echo "<td>" . $row['id'] . "</td>";
			echo "<td>" . $row['first_name'] . $row['last_name'] . "</td>";
			echo "<td>" . $row['email'] . "</td>";
			echo "<td>" . "Edit" . " Delete" . "</td>";
			echo "</tr>";
		}
	}else {
		echo " 0 results";
	}
?>