<?php 
session_start();
require './Classes/Database.php';
require './Classes/Admin.php';

if(isset($_SESSION['actor']['id'])) {
	header("Location: dashboard.php");
}

if(isset($_POST["submit"])) {

	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = $admin->signin($username,$password);

	if($result['error'] === false) {
		
		$_SESSION['actor'] = [
			'id' => $result['data']['id'],
			'email' => $result['data']['email'],
		];
		header('location:dashboard.php');
		exit;

	}else {
		$message = $result['msg'];
		echo "<script> alert('$message'); </script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin</title>
</head>
<body>

	<form action="<?= $_SERVER['PHP_SELF'];?>" method="post">
		<label for="username">Username: </label>
		<input type="text" name="username" required/><br>

		<label for="password">Password: </label>
		<input type="password" name="password" required/><br>

		<button type="submit" name="submit">Login</button>
	</form>

</body>
</html>