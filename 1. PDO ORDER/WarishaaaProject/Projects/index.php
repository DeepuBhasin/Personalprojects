<?php
if (isset($_COOKIE['user_id'])) {
	header('location:login.php');
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Warishah Jaffari TECH 3740 Project</title>
</head>

<body>
	<h1>Welcome to Warishah Jaffari TECH 3740 Project</h1>

	<ul>
		<li><a href="view_admin.php">View All Admin</a></li>
	</ul>

	Enter a partial addressto find admin<br />
	(* for listing all admin)<br />
	<form action="search_admin.php" method="GET">
		<input type="text" name="keyword" id="" required="" placeholder="Search admin">
		<input type="submit" value="Search">
	</form>
	<br />
	<form action="login.php" method="POST">
		Employee Login ID : <input type="text" name="username" id="" required="" placeholder="Enter Employee Login ID"><br />
		Password : <input type="password" name="password" id="" required="" placeholder="Enter Password">
		<input type="submit" name="login" value="Submit">
	</form>
</body>

</html>