<?php include_once'_db.php';
session_start();
if(isset($_SESSION['type'])){
	if($_SESSION['type']=='admin'){
		header('location:admin/');
	}
	if($_SESSION['type']=='user'){
		header('location:user/');
	}
}




if(isset($_POST['login'])){

	$email = $_POST['email'];

	$password = $_POST['password'];

	$loginType = $_POST['loginType'];

	$stmt = $DBH->prepare("SELECT * FROM  userlogin WHERE email=:email AND password=:password and type=:type"); // 
    	
    $stmt->execute(['email'=>$email,'password'=>$password,'type'=>$loginType]);
    	
    	if($stmt->rowCount()>0)
    	{
    		$row = $stmt->fetch(PDO::FETCH_OBJ);
    		
    		
			$_SESSION['id']=$row->id;
    		$_SESSION['name']=$row->name;
    		$_SESSION['email']=$row->email;
    		$_SESSION['type']=$row->type;
			
			if($loginType=='admin'){
				header('location:admin/');
			}else if($loginType=='user'){
				header('location:user/');
			}
		}else{
			header('location:index.php?status=danger&message='.urlencode('Invalid Email Address or Password'));
		}
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <a class="navbar-brand" href="#">Welcome To Login System</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	</nav>
	<div class="container">
	<br/><br/>

	<?php
	if(isset($_GET['status'])){
		$color= $_GET['status'];
		$message= $_GET['message'];
		?>
		<div class="row">
			<div class="col-6">
				<div class="alert alert-<?= $color;?>">
					<?= $message; ?>
				</div>
			</div>
		</div>		
	<?php	
		}


	?>
		<div class="row">
			<div class="col-6">	
				<h1>Welcome Login System using PDO</h1>
			</div>
		</div>
		<div class="row">	
			<div class="col-6">
				<form action="<?= $_SERVER['PHP_SELF'];?>" method="post">
			  
			    <div class="form-group">
			      <label for="email">Email Address</label>
			      <input type="email" class="form-control" id="email" name="email"  placeholder="Enter Email Address" required="">
			    </div>
			    <div class="form-group">
			      <label for="password">Password</label>
			      <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required="">
			    </div>
			    <div class="form-group">
			      <label for="logintype">Login Type</label>
			      <select class="form-control" id="logintype" name="loginType" required="">
			        <option>Select Type</option>
			        <option value="admin">Admin</option>
			        <option value="user">User</option>
			      </select>
			    </div>
			    <div class="form-group">
			    	<button type="submit" class="btn btn-success" name="login">Login</button>
			    	<button type="reset" class="btn btn-danger">Clear</button>
			  	</div>
			</form>
			</div>
			
		</div>
	</div>
</body>
</html>