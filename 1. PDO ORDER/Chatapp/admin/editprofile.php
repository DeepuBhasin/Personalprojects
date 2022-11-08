<?php
include('header.php');
require './main.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $id = $_POST['user_id'];
    $response = $updateProfile->validateData($_POST, $id);
    
    if($response === true){
        if($_POST['page'] == 'search'){
            header('location:searchfriend.php?message='.urlencode('User Profile Updated Successfully'));   
            exit; 
        }
        else {
            header('location:allusers.php?message='.urlencode('User Profile Updated Successfully'));
            exit;
        }
    }
}
$id = $_GET['id'];
$page_data = $updateProfile->getUserData($id);
?>
<div class="section-container">
      <div class="section-title">
        <h2>Update Profile</h2>
      </div>
      <div class="section-form">
        <?php include './../message.php';?>
      <form action="<?= $_SERVER['PHP_SELF'];?>" method="POST">
      <input type="hidden" name="user_id" value="<?= $id?>"/>
      <input type="hidden" name="page" value="<?= isset($_GET['page']) ? $_GET['page'] : ''; ?>" />
          <div class="section-form-item">
            <label for="firstName">First Name *</label>
            <input type="text" id="firstName" name="first_name" class="input-form" placeholder="Enter First Name" required="true" value="<?= $page_data['first_name']?>"/>
          </div>
          <div class="section-form-item">
            <label for="lastname">Last Name *</label>
            <input type="text" id="lastname" name="last_name" class="input-form" placeholder="Enter Last Name" required="true" value="<?= $page_data['last_name']?>"/>
          </div>
          <div class="section-form-item">
            <label for="mobile">Mobile Number *</label>
            <input type="number" min="1" minlength="10" id="mobile" name="mobile_number" class="input-form" placeholder="Enter Mobile Number" required="true" value="<?= $page_data['mobile']?>"/>
          </div>
          <div class="section-form-item">
          <label for="dateOFBirst">Date of Birth *</label>
            <input type="date" id="dateOFBirst" name="date_of_birth" class="input-form" placeholder="Enter Date of Birth" required="true" value="<?= date('Y-m-d', strtotime($page_data['date_of_birth']))?>"/>
          </div>
          <div class="section-form-item">
          <label for="age">Age *</label>
            <input type="number" id="age" name="age" min="1" class="input-form" placeholder="Enter Age" required="true" value="<?= $page_data['age']?>"/>
          </div>
          <div class="section-form-button">
            <button type="submit" class="btn-success" name="signup">Update</button>
          </div>
        </form>
      </div>
    </div>
  <?php include('footer.php'); ?>