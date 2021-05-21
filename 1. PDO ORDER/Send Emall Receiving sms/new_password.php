<?php
include_once('database.php');

if(isset($_GET['code']))
{
	$code=$_GET['code'];
	if(!empty($code))
	{
		 try{

                $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                

                 $stmt = $DBH->prepare("SELECT * FROM login_user where code=:code and status=:status"); // 
                
                //Assigning Values to parameters  
                $stmt->execute(['code'=>$code,'status'=>1]);

                if($stmt->rowCount()<=0)
                {
                  header("location:index.php?message=already_fail");
                }

            }
            catch(PDOException $e)
            {
              echo "Error: " . $e->getMessage();
            }
	}
	else
	{
		header("location:index.php?message=para_fail");
	}	
}
else
{
	header("location:index.php?message=para_fail");
}	

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>New Password</title>
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
                 <h3>New Password</h3>
                 <br/>
                    </center>
                    <br/>
                  <form onsubmit="return abc();" action="new_password_proccess.php" method="post">
                    <div class="form-group">
                    <input type="hidden" name="code" value="<?= $code;?>">
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
                  <br/><a href="index.php">Home </a>
                </div>  
        </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
  function abc()
  {

    var new_password= document.getElementById('new_password').value;
    var confirm_password= document.getElementById('confirm_password').value;
    if(new_password.length==0 || confirm_password==0)
    {
    	alert("Please Enter Password");
    	return false;
    }	
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
