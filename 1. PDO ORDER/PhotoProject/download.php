<?php
session_start();
if (!isset($_SESSION['downloadImage'])) {
   header('location:index.php?status=error&message=Access Denied');
}
	$downloadImage= $_SESSION['downloadImage'];
include 'header.php';
?>
<div class="container">
<br/>
	<div class="row">
		<h2>Your Image is Ready for Download</h2>
	</div>
	<div class="row">
		<div class="col-md-4">
		<img src="images/created/<?= $downloadImage;?>" class="img-responsive img-thumbnail"/>
		</div>
		<div class="col-md-6">
		<a href="images/created/<?= $downloadImage;?>" class="btn btn-success" download>Download Image</a>
		<a href="index.php" class="btn btn-primary">Click New Image</a>
		</div>
	</div>
</div>
<?php 

session_destroy();
?>