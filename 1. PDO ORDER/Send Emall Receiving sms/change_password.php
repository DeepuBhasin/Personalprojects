
<?php
session_start();
if(!isset($_SESSION['user_name']))
{
  header("location:view.php");
}

include_once('database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Create User</title>
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
                 <h1>CHANGE PASSWORD</h1>
                 <br/>
                    </center>
                    <br/>
                    <?php
                       
                       if(isset($_POST['submit']))
                        {
                          
                          $old_password=stripcslashes(htmlspecialchars(trim($_POST['old_password'])));
                          $new_password=stripcslashes(htmlspecialchars(trim($_POST['new_password'])));
                          
                          if(!empty($old_password) && !empty($new_password))
                          {

                            try{

                                $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $DBH->beginTransaction();

                                 $stmt = $DBH->prepare("SELECT * FROM login_user where id=:id and password=:old_password"); // 
                                
                                //Assigning Values to parameters  
                                $stmt->execute(['id'=>1,'old_password'=>$old_password]);

                                if($stmt->rowCount()<=0)
                                {
                                  ?>
                                  <div class="alert alert-danger">
                                    <strong>Error : </strong> Old Password Do not Match.
                                  </div>
                                  <?php
                                }
                                else
                                {
                                   $stmt = $DBH->prepare("UPDATE login_user set password=:new_password where id=:id"); // 
                                
                                    //Assigning Values to parameters  
                                    $stmt->execute(['new_password'=>$new_password,'id'=>1]);
                                    $DBH->commit();
                                     ?>
                                      <div class="alert alert-success">
                                        <strong>Success : </strong> Password Updated Successfully
                                      </div>
                                      <?php
                                     
                                }  
                            }
                            catch(PDOException $e)
                                {
                                  $DBH->rollback();
                                  echo "Error: " . $e->getMessage();
                                }
                          }
                          else
                          { ?>
                            <div class="alert alert-danger">
                              <strong>Error : </strong> Please Enter all Mandatory Fields
                            </div>
                            <?php
                          } 
                        }  
                    ?>

                  <form onsubmit="return abc();" action="<?= $_SERVER['PHP_SELF'];;?>" method="post">
                    <div class="form-group">
                      <label for="old_password">Old Password *</label>
                      <input type="text" class="form-control" id="old_password" placeholder="Enter User Name" name="old_password" required="required">
                    </div>
                    <div class="form-group">
                      <label for="new_password">New Password *</label>
                      <input type="password" class="form-control" id="new_password" placeholder="Enter Password" name="new_password" required="required">
                    </div>  
                    <div class="form-group">
                      <label for="confirm_password">Confrim Password *</label>
                      <input type="password" class="form-control" id="confirm_password" placeholder="Enter Confirm Password" name="confirm_password" required="required">
                    </div>
                    <button type="submit" class="btn btn-success" name="submit">Login</button>
                    <button type="submit" class="btn btn-info" name="reset">Reset</button>
                  </form>
                </div>  
        </div>

<?php include_once('footer.php');?>      

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
  function abc()
  {

    var new_password= document.getElementById('new_password').value;
    var confirm_password= document.getElementById('confirm_password').value;

    if(new_password===confirm_password)
    {
      return true;
    } 
    else
    {
      alert("New Password and Confirm Password Do not Match");
      return false;
    } 

  }
</script>

</html>
