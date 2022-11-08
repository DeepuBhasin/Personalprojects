<?php
include('header.php');
require './main.php';
$id = $_SESSION['login_user']['id'];
$response = $admin->getAllUsers($id);

?>
<div class="section-container">
    <div class="section-title">
        <h2>All Users</h2>
        <?php if(isset($_GET['message'])){
                include './../message.php';
            }
        ?>
    </div>
    <center>
        <table style="width: 900px; position:relative; left:-200px;">
            <thead>
                <tr>
                <th>Sri</th>
                <th>Name</th>
                <th>Email Id</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $c = 0;
                foreach ($response['data'] as $value) : ?>
                    <tr>
                        <td><?= ++$c; ?></td>
                        <td><?= $value['first_name'] ?> <?= $value['last_name'] ?></td>
                        <td><?= $value['email'] ?></td>
                        <td style="width: 400px;">
                            <a style="text-decoration:none; color:#000; padding:5px; background-color: white;" href="viewfriendprofile.php?id=<?= $value['id'] ?>">View Profile</a>
                            <a style="text-decoration:none; color:#000; padding:5px; background-color: white;" href="editprofile.php?id=<?= $value['id'] ?>">Edit Profile</a>
                            <a style="text-decoration:none; color:#000; padding:5px; background-color: white;" href="deleteprofile.php?id=<?= $value['id'] ?>">Delete Profile</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        </center>
    
</div>
<?php include('footer.php'); ?>