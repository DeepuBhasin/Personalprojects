<?php
session_start();
if(!isset($_SESSION['user_name']))
{
	header("location:index.php");
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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
</head>
<body>
<?php include_once('header.php');?>
<div class="container">

      <br/>
      <br/>
            <div class="row">
              <center style="color:#000;">
                 <h1>CREATE USER</h1>
                 <br/>
                    </center>
                    <br/>
                    <?php
                      if(isset($_POST['submit']))
                        {
                          
                          $full_name=stripcslashes(htmlspecialchars(trim($_POST['full_name'])));
                          $destination_number=stripcslashes(htmlspecialchars(trim($_POST['destination_number'])));
                          $email_id=strtolower(stripcslashes(htmlspecialchars(trim($_POST['email_id']))));
                          $user_limit=strtolower(stripcslashes(htmlspecialchars(trim($_POST['user_limit']))));
                          

                          if(!empty($full_name) && !empty($destination_number) && !empty($email_id) && !empty($user_limit))
                          {
                            try{
                            
                                $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $DBH->beginTransaction();

                                 $stmt = $DBH->prepare("SELECT * FROM didww_user where email_id=:email_id and user_number=:destination_number"); // 
                                
                                //Assigning Values to parameters  
                                $stmt->execute(['email_id'=>$email_id,'destination_number'=>$destination_number]);

                                if($stmt->rowCount()>0)
                                {
                                  ?>
                                  <div class="alert alert-danger">
                                    <strong>Error : </strong> User Already Registerd with this Email Id and Phone Number.
                                  </div>
                                  <?php
                                }
                                else
                                {
                                    // binding Parameters and provide name to parameters 
                                    $stmt = $DBH->prepare("INSERT into didww_user(full_name,email_id,user_number,user_limit,status,created_dt) Values(:full_name,:email_id,:destination_number,:user_limit,:status,:created_dt)"); // 
                                      
                                      //Assigning Values to parameters  
                                      $stmt->execute(['full_name'=>$full_name,'email_id'=>$email_id,'destination_number'=>$destination_number,'user_limit'=>$user_limit,'status'=>1,'created_dt'=>$get_time]);

                                     $DBH->commit();

                                       ?>
                                        <div class="alert alert-success">
                                          <strong>Success : </strong> Data Entered Successfully.
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

                  <form onsubmit="return confirm('Are your sure you want to Enter User Details ? ');" action="<?= $_SERVER['PHP_SELF'];;?>" method="post">
                    <div class="form-group">
                      <label for="full_name">Full Name *</label>
                      <input type="full_name" class="form-control" id="full_name" placeholder="Enter Full Name" name="full_name" required="required">
                    </div>
                    <div class="form-group">
                      <label for="destination_number">Destination Number *</label>
                      <input type="number" class="form-control" id="destination_number" placeholder="Enter Destination Number" name="destination_number" required="required">
                    </div>
                    <div class="form-group">
                      <label for="email">Email Id *</label>
                      <input type="email" class="form-control" id="email" placeholder="Enter Email Id" name="email_id" required="">
                    </div>
                    <div class="form-group">
                      <label for="user_limit">Limit *</label>
                      <input type="number" class="form-control" id="user_limit" placeholder="Enter User Limit " name="user_limit" min="1" max="100000" required="">
                    </div>
                    <button type="submit" class="btn btn-success" name="submit">Submit</button>
                    <button type="reset" class="btn btn-info">Reset</button>
                  </form>
                </div>  
            </div>
            <?php include_once('footer.php');?>  
    </body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script type="text/javascript">
  $(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>
</html>
