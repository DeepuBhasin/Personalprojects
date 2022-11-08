<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
   require './main.php';
    $response = $signup->validateData($_POST);

    if($response === true){
        header('location:signup.php?message='.urlencode('User Created Successfully'));
    }
}
include('header.php'); ?>
<a href="index.php" class="btn-link">Login</a>
<div class="section-container">
      <div class="section-title">
        <h2>Sign Up</h2>
      </div>
      <div class="section-form">
        <?php include './message.php';?>
      <form action="<?= $_SERVER['PHP_SELF'];?>" method="POST">
          <div class="section-form-item">
            <label for="firstName">First Name *</label>
            <input type="text" id="firstName" name="first_name" class="input-form" placeholder="Enter First Name" required="true"/>
          </div>
          <div class="section-form-item">
            <label for="lastname">Last Name *</label>
            <input type="text" id="lastname" name="last_name" class="input-form" placeholder="Enter Last Name" required="true"/>
          </div>
          <div class="section-form-item">
            <label for="mobile">Mobile Number *</label>
            <input type="number" min="1" minlength="10" id="mobile" name="mobile_number" class="input-form" placeholder="Enter Mobile Number" required="true"/>
          </div>
          <div class="section-form-item">
            <label for="emailid">Email Id *</label>
            <input type="email" id="emailid"  name="email_id" class="input-form" placeholder="Enter Email Id" required="true"/>
          </div>
          <div class="section-form-item">
          <label for="password">Password *</label>
            <input type="password" id="password" name="password" class="input-form" placeholder="Enter Password" required="true"/>
          </div>
          <div class="section-form-item">
          <label for="confirm">Confirm Password *</label>
            <input type="password" id="confirm" name="confirm" class="input-form" placeholder="Enter Password" required="true"/>
          </div>
          <div class="section-form-item">
          <label for="dateOFBirst">Date of Birth *</label>
            <input type="date" id="dateOFBirst" name="date_of_birth" class="input-form" placeholder="Enter Date of Birth" required="true"/>
          </div>
          <div class="section-form-item">
          <label for="age">Age *</label>
            <input type="number" id="age" name="age" min="1" class="input-form" placeholder="Enter Age" required="true"/>
          </div>
          <div class="section-form-button">
            <button type="submit" class="btn-success" name="signup">Sign Up</button>
            <button type="reset" class="btn-danger">Clear</button>
          </div>
        </form>
      </div>
    </div>
  <?php include('footer.php'); ?>