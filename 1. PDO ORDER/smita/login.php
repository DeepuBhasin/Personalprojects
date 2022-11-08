<?php 
require_once './Classes/Database.php';
require './Classes/User.php';

session_start();

if(isset($_SESSION['actor']['id'])) {
	header("Location: index.php");
}



if(isset($_POST["submit"])) {

	$email = $_POST["email"];
	$password = $_POST["password"];

	$result = $user->signin($email,$password);

	if($result['error'] === false) {
		
		$_SESSION['actor'] = [
			'id' => $result['data']['id'],
			'email' => $result['data']['email'],
		];
		header('location:index.php');
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
	<title>Login</title>
</head>
<body>
	<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
		<label for="email">Email: </label>
		<input type="email" name="email" required/><br>

		<label for="password">Password: </label>
		<input type="password" name="password" required/><br>

		<button type="submit" name="submit">Login</button>
	</form>
	<h3>Not a user? <a href="registration.php">Click here</a></h3>
	<h3><a href="admin.php">Admin</a></h3>
</body>
</html>