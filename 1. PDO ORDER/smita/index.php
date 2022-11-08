<?php

require_once './Classes/Database.php';
require_once './Classes/User.php';

session_start();

if(isset($_SESSION['actor']['id'])) {
	$user = $user->getUserData($_SESSION['actor']['id']);
}
else {
	header("Location: login.php");
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

</body>
</html>