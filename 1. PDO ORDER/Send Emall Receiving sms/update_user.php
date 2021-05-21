<?php
session_start();
if(!isset($_SESSION['user_name']))
{
	header("location:index.php");
}
include_once('database.php');
if(isset($_GET['id']))
{
  if(empty($_GET['id']))
  {
    header("location:create_user.php");
  }
  else
  {
    $user_id=base64_decode($_GET['id']);
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $DBH->prepare("SELECT * FROM didww_user where user_id=:id"); // 
    
    //Assigning Values to parameters  
    $stmt->execute(['id'=>$user_id]);

    if($stmt->rowCount()<=0)
    {
      header("location:create_user.php");
    } 
    else
    {
       while($row = $stmt->fetch(PDO::FETCH_OBJ))
        {
          $row_user_id=$row->user_id;
          $row_full_name = $row->full_name;
          $row_user_number = $row->user_number;
          $row_email_id = $row->email_id;
          $row_user_limit = $row->user_limit;
          $row_status = $row->status;
        }
    } 
  }  
} 
else
{
  header("location:create_user.php");
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Update User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
</head>
<body>
<?php include_once('header.php');?>
<div class="container">

      <br/>
      <br/>
            <div class="row">
              <center style="color:#000;">
                 <h1>Update User</h1>
                 <br/>
                    </center>
                    <br/>
                  <form onsubmit="return confirm('Are your sure you want to Update User Details ? ');" action="update_proccess.php" method="post">
                    <input type="hidden" name="user_id" value="<?= $user_id?>">
                    <div class="form-group">
                      <label for="full_name">Full Name *</label>
                      <input type="text" class="form-control" id="full_name" placeholder="Enter Full Name" name="full_name" required="required" value="<?= $row_full_name; ?>">
                    </div>
                    <div class="form-group">
                      <label for="destination_number">Destination Number *</label>
                      <input type="number" class="form-control" id="destination_number" placeholder="Enter Destination Number" name="destination_number" required="required" value="<?= $row_user_number; ?>">
                    </div>
                    <div class="form-group">
                      <label for="email">Email Id *</label>
                      <input type="email" class="form-control" id="email" placeholder="Enter Email Id" name="email_id" required="" value="<?= $row_email_id ?>">
                    </div>
                    <div class="form-group">
                      <label for="user_limit">Limit *</label>
                      <input type="number" class="form-control" id="user_limit" placeholder="Enter User Limit " name="user_limit" min="1" max="100000" required="" value="<?= $row_user_limit ?>">
                    </div>
                     <div class="form-group">
                      <label for="email">Status *</label>
                      <select name="status" required="" class="form-control">
                        <option value="">Select Status</option>
                        <option <?php if($row_status==1){echo "SELECTED";}?> value="1">Active</option>
                        <option <?php if($row_status==0){echo "SELECTED";}?> value="0">Inactive</option>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-success" name="submit">Update</button>
                  </form>
                </div>
              </div>
              <?php include_once('footer.php');?>  
</body>
</html>
