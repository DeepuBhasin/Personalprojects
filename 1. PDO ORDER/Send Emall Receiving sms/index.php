
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
  <title>Login</title>
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
                 <h3>Login</h3>
                 <br/>
                    </center>
                    <br/>
                    <?php
                 if(isset($_GET['message']))
                 {
                  if($_GET['message']=='success')
                  {
                    ?>
                    <div class="alert alert-success">
                    <strong>Success</strong> Password Reset Successfully
                   </div>
                    <?php
                  }
                  if($_GET['message']=='already_fail')
                  {
                    ?>
                    <div class="alert alert-danger">
                    <strong>Error</strong> Link is not Available.
                   </div>
                    <?php
                  }
                  if($_GET['message']=='para_fail')
                  {
                    ?>
                    <div class="alert alert-danger">
                    <strong>Error</strong> Access Denied
                   </div>
                    <?php
                  }
                  if($_GET['message']=='empty_fail')
                  {
                    ?>
                    <div class="alert alert-danger">
                    <strong>Error</strong> Access Denied
                   </div>
                    <?php
                  }
                  if($_GET['message']=='access_fail')
                  {
                    ?>
                    <div class="alert alert-danger">
                    <strong>Error</strong> Access Denied
                   </div>
                    <?php
                  } 

                 }  
                 
                      

                        if(isset($_POST['submit']))
                        {
                          
                          $user_name=stripcslashes(htmlspecialchars(trim($_POST['user_name'])));
                          $password=stripcslashes(htmlspecialchars(trim($_POST['password'])));
                          
                          if(!empty($user_name) && !empty($password))
                          {

                            try{

                                $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                

                                 $stmt = $DBH->prepare("SELECT * FROM login_user where user_name=:user_name and password=:password"); // 
                                
                                //Assigning Values to parameters  
                                $stmt->execute(['user_name'=>$user_name,'password'=>$password]);

                                if($stmt->rowCount()<=0)
                                {
                                  ?>
                                  <div class="alert alert-danger">
                                    <strong>Error : </strong> Invalid Username or Password.
                                  </div>
                                  <?php
                                }
                                else
                                {
                                    while($row = $stmt->fetch(PDO::FETCH_OBJ))
                                    {
                                      
                                      
                                    $_SESSION=array(
                                        'id'=>$row->id,
                                        'user_name'=>$row->user_name,
                                        );
                                      header("location:view.php");
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
                      <label for="user_name">Enter Username *</label>
                      <input type="user_name" class="form-control" id="user_name" placeholder="Enter User Name" name="user_name" required="required">
                    </div>
                    <div class="form-group">
                      <label for="password">Password *</label>
                      <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" required="required">
                    </div>
                    <button type="submit" class="btn btn-success" name="submit">Login</button>
                    <button type="submit" class="btn btn-info" name="reset">Reset</button>
                  </form>
                  <br/><a href="forget.php">Forget Password ?</a>
                </div>  
        </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</html>
