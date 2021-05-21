<?php
session_name("name");
require_once("class/userClass.php");
$usrObj=new userClass();
if ($usrObj->get_session())
{
  header("location:dashboard.php"); 
  
}
if(isset($_GET['type'])){
  $type=$_GET['type'];
}
if(isset($_POST['emailidf']) && isset($_POST['password'])){
  $emailidf=addslashes($_POST['emailidf']);
  $password=addslashes($_POST['password']);
}


 
if ($_SERVER['REQUEST_METHOD']=="POST")
{
  $login=$usrObj::login($emailidf,$password);

  if ($login['status']=='Success')
  {
    $loginarray= $login['result'];
    $_SESSION['login']=true; 
    $_SESSION['id']=$loginarray[id] ;
    $_SESSION['admintype']=$loginarray[admintype] ;
   // header("location:dashboard.php");  
    if($_POST['admintype'] == "0")
      header("location:dashboard.php");  
    else if($_POST['admintype'] == "1")
      header("location:dashboard.php");
      
      
    else
      $_SESSION['msg']="Access not authorized!";   
     
  }
  else
  {
    $_SESSION['msg']="Wrong Username and password";
    
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

        <!-- Login card -->
        <form class="login-form" action="<?php echo $_SERVER['PHP_SELF'];?>?type=login" method="POST">
          <div class="card mb-0">
            <div class="card-body">
              <div class="text-center mb-3">
                <i class="icon-people icon-2x text-warning-400 border-warning-400 border-3 rounded-round p-3 mb-3 mt-1"></i>
                <h5 class="mb-0">Login to your account</h5>
                <span class="d-block text-muted">Your credentials</span>
              </div>

                
                    <br><br>
                  </label>

                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="user" name="emailidf" aria-describedby="user" placeholder="Username" required="required">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="pwd" name="password" placeholder="Password" required="required">
                    </div>
                      <div class="form-group">
                    
                  <select name="admintype" id="admintype" class="form-control form-control-user">
                   
                      <option value="Choose Your Login Type:">Choose Your Login Type:</option>
                      
                     <option value="0">Master Login</option>
                     <option value="1">Staff Login</option>
                     <option value="2">Client Login</option>

                   
   
                   </select>
                    </div>
                   
                     <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Login <i class="icon-circle-right2 ml-2"></i></button>
              </div>

              <div class="form-group d-flex align-items-center">

                <a href="login_password_recover.html" class="ml-auto">Forgot password?</a>
              </div>

              <div class="form-group">
                <a href="#" class="btn btn-light btn-block">Sign up</a>
              </div>

              
            </div>
          </div>
        </form>
        <!-- /login card -->

      </div>
      <!-- /content area -->

    </div>
    <!-- /main content -->

  </div>
  <!-- /page content -->

</body>
</html>
