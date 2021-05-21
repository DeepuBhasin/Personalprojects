<?php
session_start();
if($_SESSION['type']!='user'){
	header('location:../index.php');
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>User Page</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
	
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <a class="navbar-brand" href="#">Welcome To Login System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../logout.php">Logout
        </a>
      </li>
      </ul>
    
  </div>
</nav>
	<div class="container">
	<br/><br/>
		<div class="row">
			<div class="col-12">	
				<h1>Welcome User to Login System using PDO</h1>
			</div>
		</div>	
		<div class="row">
			<div class="col-12">	
			<h1 class="text-success">Hello !!! <?= $_SESSION['email'];?></h1>
		</div>
		
		</div>
	</div>
</body>
</html>