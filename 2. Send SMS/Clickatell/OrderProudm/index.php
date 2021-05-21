<?php
session_start();
if(isset($_SESSION['user'])){
	header('location:sendBulkSms.php');
	exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>SMS Service By Henrry Goels</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#0083C4;">
<nav class="navbar navbar-inverse" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">SMS Service By Henrry Goels</a>
		</div>
	</div>
</nav>

<div class="container">
	<?php
	if(isset($_POST['login'])){

		function filter($data=null){
			$variable = htmlspecialchars(trim(addslashes($data)));
			return $variable;
		}
		
		$username=filter($_POST['username']);
		$password=filter($_POST['password']);
		
		if($username=='Orderproudm' && $password=='123456789'){
			$_SESSION['user']='Orderproudm';
			header('location:sendBulkSms.php?a=success');
			exit;
		}
		else{
			?>
			<div class="col-md-8 col-lg-offset-2">
				<div class="alert alert-danger msg">
					Invalid Username or Password
					<script type="text/javascript">
						// setTimeout(function(){$('.msg').hide();},3000);
					</script>
				</div>
			</div>
			<?php
		}
	}	



?>
	<div class="col-md-8 col-md-offset-2">
		<form action="<?= $_SERVER['PHP_SELF'];?>" method="post" autocomplete="off" enctype="multipart/form-data">
			<div class="form-group">
			<!-- * (use comma separation for bulk SMS) -->
	           <label for="username" class="control-label" style="color: #fff;">Enter Username</label>
	         <input type="text" id="username" class="form-control" name="username" placeholder="Please Enter Username *" required="">
	        </div>

		    <div class="form-group">
			<!-- * (use comma separation for bulk SMS) -->
	           <label for="password" class="control-label" style="color: #fff;">Enter Password</label>
	         <input type="password" id="password" class="form-control" name="password" placeholder="Please Enter Password *" required="">
	        </div>
		    <div class="form-group">
		   		<button type="submit" class="btn btn-success" name="login">LOGIN</button>
		   		<button type="reset" class="btn btn-primary">CLEAR</button>
		    </div>
		</form>
	</div>
</div>	
	
<script type="text/javascript">
$(document).ready(function(){
	$('form').submit(function(){
		var username = $('#username').val().trim();
		var password = $('#password').val().trim();
		
		
		if(Boolean(username)==false)
		{
			alert('PLease Enter Username');
			$('#username').val('').focus();
			return false;
		}

		if(Boolean(password)==false)
		{
			alert('PLease Enter Password');
			$('#password').val('').focus();
			return false;
		}	

	});
});
</script>
</body>
</html>