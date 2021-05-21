
<?php
session_start();
if(isset($_SESSION['user_name']))
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

<div class="container">
 
      <br/>
            <div class="row">
              <center style="color:#000;">
                 <h1>Welcome To Email Management System</h1>
                 <h3>Forget Password</h3>
                 <br/>
                    </center>
                    <br/>
                    <?php
                      

                        if(isset($_POST['submit']))
                        {
                          
                          $email_id=stripcslashes(htmlspecialchars(trim($_POST['email_id'])));
                          
                          
                          if(!empty($email_id))
                          {

                            try{

                                $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                

                                 $stmt = $DBH->prepare("SELECT * FROM login_user where email_id=:email_id"); // 
                                
                                //Assigning Values to parameters  
                                $stmt->execute(['email_id'=>strtolower($email_id)]);

                                $DBH->beginTransaction();
                                if($stmt->rowCount()<=0)
                                {
                                  ?>
                                  <div class="alert alert-danger">
                                    <strong>Error : </strong> Invalid Registered Email Id
                                  </div>
                                  <?php
                                }
                                else
                                {
                                  $code=md5(md5(md5(md5(md5(md5(time()))))));
                                  $stmt = $DBH->prepare("UPDATE login_user SET status=:status,code=:code  where email_id=:email_id"); // 
                                
                                  //Assigning Values to parameters  
                                  $stmt->execute(['status'=>1,'code'=>$code,'email_id'=>strtolower($email_id)]);

                                  $subject ="Forget Password Link";

                                  $base_url=$_SERVER['SERVER_NAME'];

                                  $message="Please Click on below Link to reset your Password.\r\n <br/> \r\n <br/>  
                                  <a href='".$base_url."/new_password.php?code=$code'>Click Here </a> \r\n <br/> \r\n <br/>
                                  OR
                                  \r\n <br/> \r\n <br/>
                                  ".$base_url."/new_password.php?code=$code";
                                  $send = mail(strtolower($email_id),$subject,$message,$headers);

                                    if($send)
                                    {  

                                     
                                     $DBH->commit();
                                      ?>
                                      <div class="alert alert-success">
                                        <strong>Success : </strong> Link Send Successfully Please check your Email Inbox
                                      </div>
                                      <?php
                                     }
                                   else
                                    {
                                      ?>
                                      <div class="alert alert-danger">
                                        <strong>Error : </strong> Link not send
                                      </div>
                                      <?php
                                    }  
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

                  <form action="<?= $_SERVER['PHP_SELF'];;?>" method="post">
                    <div class="form-group">
                      <label for="email_id">Enter Registered Email Id *</label>
                      <input type="email" class="form-control" id="email_id" placeholder="Enter User Name" name="email_id" required="required">
                    </div>
                   
                    <button type="submit" class="btn btn-success" name="submit">Send Link</button>
                    <button type="submit" class="btn btn-info" name="reset">Reset</button>
                  </form>
                  <br/><a href="index.php">Home </a>
                </div>  
        </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</html>
