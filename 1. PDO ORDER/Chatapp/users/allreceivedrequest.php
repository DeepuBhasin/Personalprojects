<?php
include('header.php');
require './main.php';
$id = $_SESSION['login_user']['id'];
$response = $sendfrinedrequest->getAllRecivedRquest($id);

?>
<div class="section-container">
    <div class="section-title">
        <h2>Received Friend Request</h2>
    </div>
    <div class="section-form">
        <center>
        <?php
        if (!isset($response['status'])) {
            include './../message.php';
        }
        ?>
        </center>
    </div>
    <?php if (isset($response['status'])) : ?>
        
            <table style="width: 700px;">
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
                        <td style="width: 200px;">
                            <a style="text-decoration:none; color:#000; padding:5px; background-color: white;" href="accpet.php?id=<?= $value['id'] ?>">Accept</a>
                            <a style="text-decoration:none; color:#000; padding:5px; background-color: white;" href="reject.php?id=<?= $value['id'] ?>">Reject</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        
    <?php endif; ?>   
</div>
<?php include('footer.php'); ?>