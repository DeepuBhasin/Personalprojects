<?php
session_start();
require_once './Classes/Database.php';
require_once './Classes/Admin.php';
require_once './Classes/AddEvent.php';


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
 <h1>All Event List</h1>
<table border="2" cellpadding="7" cellspacing="1">
    <thead>
        <th>Sri</th>
        <th>Event Name</th>
        <th>Event Date</th>
        <th>Entered Event Date</th>
        <th>Added By</th>
    </thead>
    <tbody>
        <?php
        $c=0;
            $data = $addEvent->getAllEvent();
            foreach($data as $value){
                ?>
                <tr>
                    <td><?= ++$c?></td>
                    <td><?= $value['event_name']?></td>
                    <td><?= $value['event_date']?></td>
                    <td><?= $value['entered_event_time']?></td>
                    <td><?= $value['first_name']?> <?= $value['last_name']?></td>
                </tr>
                <?php
            }
        
        ?>
    </tbody>
</table>

</body>
</html>