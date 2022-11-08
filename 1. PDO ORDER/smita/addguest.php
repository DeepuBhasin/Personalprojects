<?php
session_start();
require_once './Classes/Database.php';
require_once './Classes/User.php';
require_once './Classes/Guest.php';


if(isset($_SESSION['actor']['id'])) {
	$user = $user->getUserData($_SESSION['actor']['id']);
}
else {
	header("Location: login.php");
}


if(isset($_POST["submit"])){

	$user_id	= $_POST['user_id']; 
    $email	= $_POST['email']; 
    $full_name	= $_POST['full_name']; 
    

	$result = $guest->createGuest($user_id,$full_name, $email );
	$message = $result['msg'];

	echo "<script> alert('$message'); </script> ";

}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Index</title>
</head>
<body>
	<?php require_once './sidebar.php';?>
	
 <h2>Welcome <?php echo $user["first_name"];  ?></h2>
 <a href="logout.php">Logout</a>

 <h1>Add Guest</h1>
 <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
 <label for="full_name">Full Name: </label>
 <input type="hidden" name="user_id" value="<?= $_SESSION['actor']['id'];?>">
<input type="text" name="full_name" required/><br>

<label for="email">Email: </label>
<input type="email" name="email" required/><br>
<button type="submit" name="submit">Add</button>
</form>
</body>
</html>