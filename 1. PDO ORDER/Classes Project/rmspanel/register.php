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
  <title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

  <!-- Global stylesheets -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
  <link href="global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
  <link href="assets/css/layout.min.css" rel="stylesheet" type="text/css">
  <link href="assets/css/components.min.css" rel="stylesheet" type="text/css">
  <link href="assets/css/colors.min.css" rel="stylesheet" type="text/css">
  <!-- /global stylesheets -->

  <!-- Core JS files -->
  <script src="global_assets/js/main/jquery.min.js"></script>
  <script src="global_assets/js/main/bootstrap.bundle.min.js"></script>
  <script src="global_assets/js/plugins/loaders/blockui.min.js"></script>
  <script src="global_assets/js/plugins/ui/ripple.min.js"></script>
  <!-- /core JS files -->

  <!-- Theme JS files -->
  <script src="global_assets/js/plugins/forms/styling/uniform.min.js"></script>

  <script src="assets/js/app.js"></script>
  <script src="/global_assets/js/demo_pages/login.js"></script>
  <!-- /theme JS files -->

</head>

<body class="bg-slate-800">

  <!-- Page content -->
  <div class="page-content">

    <!-- Main content -->
    <div class="content-wrapper">

      <!-- Content area -->
      <div class="content d-flex justify-content-center align-items-center">
 <section>
  	<?php 
		if(isset($_SESSION['msg'])) { 
	?>
	<div class="alert alert-danger" role="alert">
  		<?php echo (isset($_SESSION['msg'])) ? $_SESSION['msg'] : ''; ?>
	</div>
	<?php unset($_SESSION['msg']); } ?>
<center><form class="login-form" action="<?php echo $_SERVER['PHP_SELF'];?>?type=login" method="POST">
   <div class="card mb-0">
            <div class="card-body">
              <div class="text-center mb-6">
                <i class="icon-people icon-2x text-warning-400 border-warning-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                 <h5 class="mb-0">Register to your account</h5>
                <span class="d-block text-muted">Your credentials</span>
               
              </div>
      
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
               <div class="form-group">
                <center><button type="submit" class="btn btn-primary btn-block" href="staff_login.php">Register <i class="icon-circle-right2 ml-2"></i></button></center>
              </div>
              <hr>
               <div class="text-center">
                <a class="small" href="staff_login.php">Already have an account? Login!</a>
              </div>
               
                 
                <hr>
              </form></center>
              </section>
              <hr>
             
             
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
