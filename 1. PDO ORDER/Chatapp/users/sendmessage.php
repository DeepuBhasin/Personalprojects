<?php
include('header.php');
require './main.php';
$id = $_SESSION['login_user']['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $friend_id = $_POST['friend_id'];
    $response = $sendmessage->validateData($_POST, $id, $friend_id);
    header("location:sendmessage.php?id=$friend_id&message=" . urlencode($response));
}
$friend_id =$_GET['id'];
$data = $updateProfile->getUserData($friend_id);
$tableData = $sendmessage->getAllMessages($id, $friend_id);
?>
<div class="section-container">
    <div class="section-title">
        <h2>Send Message to <?= $data['first_name'].' '.$data['last_name']?></h2>
    </div>
    <div>
    <?php if(count($tableData) > 0) :?>
        <table style="width: 1200px; position:relative; left:-400px;">
        <thead>
            <tr>
            <th>Sri</th>
            <th>Send by (Email)</th>
            <th>Received by (Email)</th>
            <th>Message</th>
            <th>Time</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $c = 0;
            foreach ($tableData as $value) : ?>
                <tr>
                    <td><?= ++$c; ?></td>
                    <td><?= $value['sender_name'] ?> ( <?= $value['sender_email'] ?> )</td>
                    <td><?= $value['receiver_name'] ?> ( <?= $value['receriver_email'] ?> )</td>
                    <td><?= $value['message_date'];?></td>
                    <td><?= $value['message'];?></td>
                    <td style="width: 300px;">

                    <?php if($value['sender_id'] == $id) :?>
                        
                        <a style="text-decoration:none; color:#000; padding:5px; background-color: white;" href="editmessage.php?mid=<?= $value['mid'] ?>&&friend_id=<?= $friend_id;?>">Edit Message Message</a>    
                        <a style="text-decoration:none; color:#000; padding:5px; background-color: white;" href="deletemessage.php?mid=<?= $value['mid'] ?>&&friend_id=<?= $friend_id;?>">Delete Message</a>   
                    <?php else:?>
                        NA
                    <?php endif;?>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
     <?php else:?>
        <br/>
        <h3>No Previous Chat found</h3>
     <?php endif;?>
    </div>
    <div class="section-form">
        <?php include './../message.php'; ?>
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="hidden" value="<?= $friend_id?>" name="friend_id" />
            <div class="section-form-item">
                <label for="message">Enter Message *</label>
                <textarea id="message" name="message" class="input-form" placeholder="Enter Message" required="true"></textarea>
            </div>
            <div class="section-form-button">
                <button type="submit" class="btn-success" name="signup">Send</button>
            </div>
        </form>
    </div>
</div>
<?php include('footer.php'); ?>