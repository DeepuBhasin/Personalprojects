<?php

	require_once("class/userClass.php");
	
	$userObj = new userClass();
	if(isset($_POST['submit']))
{
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email1=$_POST['email1'];
$email2=$_POST['email2'];
$username=$_POST['username'];
$password=$_POST['password'];

	$newUser = $userObj::addstaff($fname,$lname,$email1,$email2,$username,$password);
	if($newUser['status']=='Sucess')
	{
		$_SESSION['msg'] = $newUser["msg"]." Our team will review information submitted and approve your registration within next 48 hours.";
}
else
{
    $_SESSION['msg'] = "User registration failed. Reason: ".$newUser["msg"];
}
    


}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    
              <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                  </div>
             
 <section>
  	<?php 
		if(isset($_SESSION['msg'])) { 
	?>
	<div class="alert alert-danger" role="alert">
  		<?php echo (isset($_SESSION['msg'])) ? $_SESSION['msg'] : ''; ?>
	</div>
	<?php unset($_SESSION['msg']); } ?>
  <form class="form"  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="fname" id="exampleFirstName" placeholder="First Name" required="required">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="lname"  id="exampleLastName" placeholder="Last Name" required="required">
                  </div>
                </div>
                <div class="form-group">
                  <input type="email1" class="form-control form-control-user" name="email1" id="exampleInputEmail" placeholder="Email Address1" required="required">
                </div>
                 <div class="form-group">
                  <input type="email2" class="form-control form-control-user" name="email2" id="exampleInputEmail" placeholder="Email Address2" required="required">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="username" class="form-control form-control-user" name="username" id="exampleInputPassword" placeholder="Username" required="required">
                  </div>
               
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Password" required="required">
                  
                </div>
                </div>
                  <div class="col-md-4">
        <button type="submit" value="submit" name="submit" class="btn" style="background-color:#4e73df; color:white;">Register</button>
      </div>
                <hr>
              </form>
              </section>
              <hr>
             
              <div class="text-center">
                <a class="small" href="staff_login.php">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>


</body>

</html>
