<?php

require_once './Classes/Database.php';
require_once './Classes/Admin.php';

session_start();

if(isset($_SESSION['actor']['id'])) {
	$user = $admin->getUserData($_SESSION['actor']['id']);
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
	<title>Admin Dashboard</title>
</head>
<body>
	<a href="logout.php">Logout</a>
 <h2>Welcome <?php echo $user['username']; ?></h2>
 <?php 
 include 'AdminSidebar.php';
 ?>
</body>
</html>