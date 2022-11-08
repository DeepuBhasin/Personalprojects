<?php 
require './Classes/Database.php';

session_start();

if(isset($_SESSION['actor']['id'])) {
	header("Location: index.php");
}

if(isset($_POST["submit"])){
	$first_name =$_POST["first_name"];
	$last_name =$_POST["last_name"];
	$email =$_POST["email"];
	$password =$_POST["password"];
	$confirmpassword =$_POST["confirmpassword"];
	
	$result = $db->registration($first_name,$last_name,$email,$password,$confirmpassword);

	$message = $result['msg'];
	echo "<script>alert('$message')</script>";
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration</title>
</head>
<body>
	<h2>Registration</h2>
	<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
		<label for="first_name">First Name: </label>
		<input type="text" name="first_name" required/> <br>

		<label for="last_name">Last Name: </label>
		<input type="text" name="last_name" required/> <br>

		<label for="email">Email: </label>
		<input type="email" name="email" required/> <br>

		<label for="password">Password: </label>
		<input type="password" name="password" required/> <br>

		<label for="confirmpassword">Confirm Password: </label>
		<input type="password" name="confirmpassword" required/> <br>

		<button type="submit" name="submit">Sign Up</button>
	</form>
	<a href="login.php">Login</a>
</body>
</html>