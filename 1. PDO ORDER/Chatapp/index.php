<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
   require './main.php';
    $response = $login->validateData($_POST);

    if($response === true){

      if($_SESSION['login_user']['login_type'] == 'u'){
        header('location:./users/dashboard.php');
      }
      if($_SESSION['login_user']['login_type'] == 'a'){
        header('location:./admin/dashboard.php');
      }
      
      
    }
}
include('header.php'); ?>
<a href="signup.php" class="btn-link">Sign up</a>
<div class="section-container">
      <div class="section-title">
        <h2>Login</h2>
      </div>
      <div class="section-form">
        <?php include './message.php';?>
      <form action="<?= $_SERVER['PHP_SELF'];?>" method="POST">
          <div class="section-form-item">
            <label for="emailid">Email Id *</label>
            <input type="email" id="emailid"  name="email_id" class="input-form" placeholder="Enter Email Id" required="true"/>
          </div>
          <div class="section-form-item">
          <label for="password">Password *</label>
            <input type="password" id="password" name="password" class="input-form" placeholder="Enter Password" required="true"/>
          </div>
          <div class="section-form-button">
            <button type="submit" class="btn-success" name="signup">Login</button>
          </div>
        </form>
      </div>
    </div>
  <?php include('footer.php'); ?>