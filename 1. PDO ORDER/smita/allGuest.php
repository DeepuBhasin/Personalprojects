<?php
session_start();
require_once './Classes/Database.php';
require_once './Classes/Admin.php';
require_once './Classes/Guest.php';


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
	<title>Index</title>
</head>
<body>
	<a href="logout.php">Logout</a>
 <h2>Welcome <?php echo $user['username']; ?></h2>
 <?php 
 include 'AdminSidebar.php';
 ?>
 <br/>
 <h1>All Guest List</h1>
<table border="2" cellpadding="7" cellspacing="1">
    <thead>
        <th>Sri</th>
        <th>Name</th>
        <th>Email Id</th>
        <th>Added By</th>
    </thead>
    <tbody>
        <?php
        $c=0;
            $data = $guest->getAllGuest();
            foreach($data as $value){
                ?>
                <tr>
                    <td><?= ++$c?></td>
                    <td><?= $value['full_name']?></td>
                    <td><?= $value['email']?></td>
                    <td><?= $value['first_name']?> <?= $value['last_name']?></td>
                </tr>
                <?php
            }
        
        ?>
    </tbody>
</table>

</body>
</html>