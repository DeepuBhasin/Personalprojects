
<?php
session_start();
if(!isset($_SESSION['user_name']))
{
  header("location:index.php");
}

include_once('database.php');
    
    $id=$_SESSION['id'];
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $DBH->prepare("SELECT * FROM login_user where id=:id"); // 
    
    //Assigning Values to parameters  
    $stmt->execute(['id'=>$id]);

     while($row = $stmt->fetch(PDO::FETCH_OBJ))
      {
        
        $row_user_name = $row->user_name;
        $row_email_id = $row->email_id;
      }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Update Profile</title>
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
            <div class="row">
              <center style="color:#000;">
                 <h1>UPDATE PROFILE</h1>
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
                                  <strong>Success : </strong> Profile Updated Successfully.
                                </div>
                                <?php
                            }
                          } 

                        if(isset($_POST['submit']))
                        {
                          
                          $user_name=stripcslashes(htmlspecialchars(trim($_POST['user_name'])));
                          $email_id=stripcslashes(htmlspecialchars(trim($_POST['email_id'])));
                          
                          if(!empty($user_name) && !empty($email_id))
                          {

                            try{

                                $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                
                                $DBH->beginTransaction();
                                 $stmt1 = $DBH->prepare("UPDATE login_user SET user_name=:user_name,email_id=:email_id where id=:id"); // 
                                
                                //Assigning Values to parameters  
                                $stmt1->execute(['user_name'=>$user_name,'email_id'=>strtolower($email_id),'id'=>$_SESSION['id']]);
                                $DBH->commit();
                                  
                                  header("location:update_profile.php?message=success");
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
                      <label for="user_name">Username *</label>
                      <input type="text" class="form-control" id="user_name" placeholder="Enter User Name" name="user_name" required="required" value="<?= $row_user_name ?>">
                    </div>
                    <div class="form-group">
                      <label for="email_id">Email Id *</label>
                      <input type="email" class="form-control" id="email_id" placeholder="Enter Email Id" name="email_id" required="required" value="<?= $row_email_id ?>">
                    </div>
                    <button type="submit" class="btn btn-success" name="submit">Update</button>
                    
                  </form>
                </div>  
        </div>
<?php include_once('footer.php');?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</html>
