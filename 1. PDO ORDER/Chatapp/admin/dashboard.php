<?php include('header.php');
require './main.php';
$id = $_SESSION['login_user']['id'];
$page_data = $updateProfile->getUserData($id);
?>
<div class="section-container">
  <div class="section-title">
    <h2>Dashboard</h2>
  </div>
  <br />
  <div class="section-form" style="text-align: center;">
    <h2>Hello <?= $page_data['first_name']; ?></h2>
    <center>
      <table cellspacing="4" cellpadding="4">
        <thead>
          <tr>
            <th>Information</th>
            <th>Data</th>
          </tr>
        </thead>
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
          <tr>
            <td>Profile Created On</td>
            <td><?= date('d-m-Y', strtotime($page_data['created_dt'])) ?></td>
          </tr>
        </tbody>
      </table>
    </center>
  </div>

</div>
<br /><br /><br /><br /><br /><br />
<?php include('footer.php'); ?>