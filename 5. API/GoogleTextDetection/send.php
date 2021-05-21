<?php
use Google\Cloud\Vision\VisionClient;
if(isset($_POST['search'])){
	$urlData=urlencode($_POST['textDetect']);
	header("location:https://iblowit.com/members/?s=$urlData");
	exit;
}



if(isset($_POST['submitImage']))
{
	$data = $_POST['imageName'];
	 $myImage = $_POST['imageName'];
	
// 	echo "<img src='$image'/>";
	
    // exit;
	list($type, $data) = explode(';', $data);
	list(, $data)      = explode(',', $data);
	$data = base64_decode($data);

	file_put_contents('image.png', $data);

	require 'google/vendor/autoload.php';

	

	$Vision = new VisionClient(['keyFile' => json_decode(file_get_contents('google/key.json'), true)]);

	$familyPhotoResourse = fopen('image.png', 'r');

	$image = $Vision->image($familyPhotoResourse, ['TEXT_DETECTION']);

	$result = $Vision->annotate($image);

	$text=$result->text();
	$fullText=$result->fullText();
	
	

	if(!isset($text))
	{
		echo '<a href="index.php">Click New Photo </a>';
		echo '<h1>Error : Text cannot be extract please try again</h1>';
		exit;
	}
	$description=$text[0]->info();	


	?>
	<!doctype html>
	<html lang="en">
	  <head>
	    <!-- Required meta tags -->
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">

	    <!-- Bootstrap CSS -->
	    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

	    <title>Find Members</title>
	  </head>
	  <body class="container" style="background-image: url('<?= $myImage;?>'); background-position-x: center; background-repeat: no-repeat;">
		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->

			</div>
		</nav>

	    
	    
	    <!-- Optional JavaScript; choose one of the two! -->

	    <!-- Option 1: Bootstrap Bundle with Popper -->
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

	    <!-- Option 2: Separate Popper and Bootstrap JS -->
	    <!--
	    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
	    -->
	  </body>
	  
	  
	  <div id="footer" style="position:absolute; bottom:20px; left:5px; right:5px; overflow:hidden;"> 
	  <footer>
	      <div>
	    	
		    	<form action="<?= $_SERVER['PHP_SELF'];?>" method="post" autocomplete="off" enctype="multipart/form-data">
				<div class="form-group">
			   		 <label for="textDetect" class="control-label" style="color: #fff;">Text Detect</label>
					 <input type="text" id="textDetect" class="form-control" name="textDetect" value="<?= $description['description'] ?>">
			    </div>
			    <br/>

			    <div class="form-group">
			        <div class="text-center">

			   		<button type="submit" class="btn btn-success" name="search">Search</button>
			   		</div>
			   	</div>
				</form>
	    	
	    </div>
	  </footer>
    </div>
	</html>



	<?php




}
else{
	header('location:index.php');
}

?>