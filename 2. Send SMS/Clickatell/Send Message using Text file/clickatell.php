
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
			<a class="navbar-brand" href="#">SMS Service By Henrry Goels</a>
		</div>
	</div>
</nav>

<div class="container">
<?php
	if(isset($_POST['send']))
	{
		$dir = "textfile/";
		$b = scandir($dir,1);

		$count=count($b)-2;

		for($x=0;$x<$count;$x++)
		{

			if(!empty($b[$x]))
			{
				unlink('textfile/'.$b[$x]);
			}	
		}

		$RandomAccountNumber = uniqid();
		$upload=$RandomAccountNumber.($_FILES['mobile']['name']);
		$source=$_FILES['mobile']['tmp_name'];
		$target='textfile/'.$upload;
		move_uploaded_file($source,$target);

		$dir = "textfile/";
		$b = scandir($dir,1);

		$count=count($b)-2;

		for($x=0;$x<$count;$x++)
		{

			$file_name=$b[$x];	
		}
		
		$file = fopen("textfile/".$file_name,"r");
		$z=0;
		while(! feof($file))
		  {
		  	$number[$z]=(float) fgets($file);
		  	++$z;
		  }
		fclose($file);
		// var_dump($number);
		// exit;
		$message =urlencode(htmlentities(trim($_POST['message'])));
		if($message=='')
		{?>
			<div class="col-md-8 col-lg-offset-2">
				<div class="alert alert-danger msg">
					Please Fill Out All Mandontary Fields. 
					<script type="text/javascript">
						setTimeout(function(){$('.msg').hide();},3000);
					</script>
				</div>
			</div>
		<?php
		}
		else
		{
			for($x=0;$x<count($number);$x++)
			{	

				$url='https://platform.clickatell.com/messages/http/send?apiKey=Yp2My1OmQMan04RwaiBW4w==&to='.$number[$x].'&content='.$message;
				$response=file_get_contents($url);
				// print_r($response);
				// exit;
				 
				if(strpos($response,'Error'))
				{
		        	 $success[$x]=$number[$x];
		        	 $status[$x]="Failed";
		        	 $reason[$x]=$response;
		        	 $yes=true;
		        }
		        else
		        {
		        	$success[$x]=$number[$x];
		        	$reason[$x]=$response;
		        	$status[$x]="Sent";
		        	$yes=true;
		        }	
			}		
			if(isset($yes))
			{
				?>
				<div class="row">
					<div class="col-md-8 col-lg-offset-2">
						<div class="alert alert-success msg">
							Program Execute Successfully
							<!-- <script type="text/javascript">
								setTimeout(function(){$('.msg').hide();},3000);
							</script> -->
						</div>
					</div>
				</div>
				<div class="row">
					<div class="table-responsive col-md-8 col-lg-offset-2" style="background-color: #9AE2CD;">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th>Serial No.</th>
								<th>Phone Number.</th>
								<th>Status</th>
								<th>Reason</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$x=0;
							for($i=0;$i<count($success);$i++)
							{ ?>
								<tr><td><?= ++$x?></td><td><?= $success[$i]?></td><td><?= $status[$i]?></td><td><?= $reason[$i]?></td></tr>
								<?php
							}	

							?>
						</tbody>
					</table>
				</div>
				</div>
				<br><br><br><br>
				<?php
			}
		}	
	}
?>
	<div class="col-md-8 col-md-offset-2">
		<form action="<?= $_SERVER['PHP_SELF'];?>" method="post" autocomplete="off" enctype="multipart/form-data">
			<div class="form-group">
		   		 <label for="mobile" class="control-label" style="color: #fff;">Upload Text File</label>
				 <input type="file" id="mobile" class="form-control" name="mobile" placeholder="" required="">
		    </div>

		    <div class="form-group">
		   		 <label for="message" class="control-label" style="color: #fff;">Message *</label>
				 <textarea rows="5" id="message" class="form-control" id="message" name="message" maxlength="700" placeholder="Please Enter Message *" required=""></textarea>
		    </div>
		    <div class="form-group">
		   		<button type="submit" name="send" class="btn btn-success" name="submit">SEND</button>
		   		<button type="reset" class="btn btn-primary">CLEAR</button>
		    </div>
		</form>
	</div>
</div>	
	
<script type="text/javascript">
$(document).ready(function(){
	$('form').submit(function(){
		var username = $('#username').val().trim();
		// var key = $('#key').val().trim();
		var mobile = $('#mobile').val().trim();
		var message = $('#message').val().trim();
		
		if(Boolean(username)==false)
		{
			alert('PLease Enter User Name');
			$('#username').val('').focus();
			return false;
		}
		if(Boolean(key)==false)
		{
			alert('PLease Enter Key');
			$('#key').val('').focus();
			return false;
		}
		if(Boolean(mobile)==false)
		{
			alert('PLease Enter Mobile Number');
			$('#mobile').val('').focus();
			return false;
		}
		// if(isNaN(mobile))
		// {
		// 	alert('PLease Enter Numbers in Mobile Field');
		// 	$('#mobile').val('').focus();
		// 	return false;
		// }	
		if(Boolean(message)==false)
		{
			alert('PLease Enter Message');
			$('#message').val('').focus();
			return false;
		}	

	});
});
</script>
</body>
</html>