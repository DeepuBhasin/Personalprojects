<?php
include('header.php');
require './main.php';
$id = $_SESSION['login_user']['id'];
$response = $sendfrinedrequest->myfriendList($id);

?>
<div class="section-container">
    <div class="section-title">
        <h2>My Friend List</h2>
    </div>
    <div class="section-form">
        <center>
        <?php if (!isset($response['status'])) {
        
            include './../message.php';
        }
        ?>
    </div>
    <?php if (isset($response['status'])) : ?>
        
            <table style="width: 900px;">
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
                        <td style="width: 300px;">
                        <a style="text-decoration:none; color:#000; padding:5px; background-color: white;" href="sendmessage.php?id=<?= $value['user_id'] ?>">Send Message</a>    
                        <a style="text-decoration:none; color:#000; padding:5px; background-color: white;" href="viewfriendprofile.php?id=<?= $value['user_id'] ?>">View Profile</a>    
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        
    <?php endif; ?>   
</div>
<?php include('footer.php'); ?>