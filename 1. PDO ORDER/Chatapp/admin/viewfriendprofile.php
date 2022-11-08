<?php include('header.php');
require './main.php';
$login_id = $_SESSION['login_user']['id'];
$friend_id =$_GET['id'];
$page_data = $updateProfile->getUserData($friend_id);
$friendRquest = $sendfrinedrequest->getFriendRquest($login_id,$friend_id);
?>
<div class="section-container">
  <div class="section-title">
    <h2>Profile of <?= $page_data['first_name']; ?></h2>
  </div>
  <br />
  
  <div class="section-form" style="text-align: center;">
    <center>
    <?php
        if (!isset($response['status'])) {
            include './../message.php';
        }
        ?>
      <table cellspacing="4" cellpadding="4">
        <tbody>
          <tr>
            <td>First Name </td>
            <td><?= $page_data['first_name']; ?></td>
          </tr>
          <tr>
            <td>Last Name </td>
            <td><?= $page_data['last_name']; ?></td>
          </tr>
          <tr>
            <td>Email Id </td>
            <td><?= $page_data['email']; ?></td>
          </tr>
          <tr>
            <td>Mobile Number </td>
            <td><?= $page_data['mobile']; ?></td>
          </tr>
          <tr>
            <td>Date of Birth</td>
            <td><?= date('d-m-Y', strtotime($page_data['date_of_birth'])) ?></td>
          </tr>
          <tr>
            <td>Age </td>
            <td><?= $page_data['age']; ?></td>
          </tr>
        </tbody>
      </table>
    </center>
  </div>

</div>
<br /><br />
<?php include('footer.php'); ?>