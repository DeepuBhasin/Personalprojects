<?php
include('header.php');
require './main.php';
$id = $_SESSION['login_user']['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $friend_id = $_POST['friend_id'];
    $mid = $_POST['mid'];
    $response = $sendmessage->updateMessage($_POST,$mid);
    // echo "<pre>";
    // var_dump($response);
    // exit;
    if(strtolower($response) == strtolower('Message Updated Successfully')) { 
        header("location:sendmessage.php?id=$friend_id&message=" . urlencode($response)); 
    } else {
        header("location:editmessage.php?mid=$mid&friend_id=$friend_id&message=".urlencode($response)); 
    }
}

$mid =$_GET['mid'];
$friend_id = $_GET['friend_id'];
$tableData = $sendmessage->getSingleMessage($mid);
?>
<div class="section-container">
    <div class="section-form">
        <?php include './../message.php'; ?>
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="hidden" value="<?= $friend_id?>" name="friend_id" />
        <input type="hidden" value="<?= $mid?>" name="mid" />
            <div class="section-form-item">
                <label for="message">Enter Message *</label>
                <textarea id="message" name="message" class="input-form" placeholder="Enter Message" required="true"><?= $tableData['message']?></textarea>
            </div>
            <div class="section-form-button">
                <button type="submit" class="btn-success" name="signup">Send</button>
            </div>
        </form>
    </div>
</div>
<?php include('footer.php'); ?>