<?php
include('header.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
   require './main.php';
    $id = $_SESSION['login_user']['id'];
    $response = $changepassword->validateData($_POST, $id);

    if($response === true){
        header('location:changepassword.php?message='.urlencode('Password Updated Successfully'));
    }
}
?>
<div class="section-container">
      <div class="section-title">
        <h2>Change Password</h2>
      </div>
      <div class="section-form">
        <?php include './../message.php';?>
      <form action="<?= $_SERVER['PHP_SELF'];?>" method="POST">
      <div class="section-form-item">
        <label for="old_password">Old Password *</label>
            <input type="password" id="old_password" name="old_password" class="input-form" placeholder="Enter Old Password" required="true"/>
        </div>  
        <label for="password">Password *</label>
            <input type="password" id="password" name="password" class="input-form" placeholder="Enter Password" required="true"/>
          </div>
          <div class="section-form-item">
          <label for="confirm">Confirm Password *</label>
            <input type="password" id="confirm" name="confirm" class="input-form" placeholder="Enter Confirm Password" required="true"/>
          </div>
          <div class="section-form-button">
            <button type="submit" class="btn-success" name="signup">Change Password</button>
          </div>
        </form>
      </div>
    </div>
  <?php include('footer.php'); ?>