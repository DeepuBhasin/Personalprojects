
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
<a href="index.php" class="btn btn-warning">BULK SMS</a>

<?php
	if(isset($_POST['send']))
	{

		$send_to=stripcslashes(htmlspecialchars(trim($_POST['send_to'])));
		$message=stripcslashes(htmlspecialchars(trim($_POST['message'])));
		$send_from=htmlspecialchars(trim($_POST['send_from']));

		if(empty($message) && empty($send_to[0]))
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
			$send_to=explode(",",$send_to);

			for($i=0;$i<count($send_to);$i++)
			{

				$auth_id = 'MAODJLMMNHYMFMN2Q1NJ';
	        	$auth_token = 'OWY2ZmEyZGYzNGFiZmRiOTdjNGM5Nzc1Y2IxNmQy';
	        	$from="+1".$send_from;
				
				$api = curl_init("https://api.plivo.com/v1/Account/$auth_id/Message/");
		        curl_setopt_array($api, array(
		            CURLOPT_RETURNTRANSFER => 1,
		            CURLOPT_POST => 1,
		            CURLOPT_HTTPHEADER => array("Authorization: Basic ".base64_encode($auth_id.':'.$auth_token)),
		            CURLOPT_POSTFIELDS => array(
		            	'src' =>$from,
		                'dst' => '+1'.$send_to[$i],
		                'text' => $_POST['message']
		            )
		        ));
		    
				$resp = curl_exec($api);
				curl_close($api);
		        $resp=json_decode($resp, true);

		        if(isset($resp['error']))
				{
		        	 $success[$i]='+1'.$send_to[$i];
		        	 $status[$i]="Failed";
		        	 $reason[$i]=$resp['error'];
		        	 $yes=true;
		        }
		        else
		        {
		        	$success[$i]='+1'.$send_to[$i];
		        	$reason[$i]="Sent Successfully";
		        	$status[$i]="Sent";
		        	$yes=true;
		        }
			}
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
								<th>Phone Number</th>
								<th>Sender From</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$x=0;
							for($i=0;$i<count($success);$i++)
							{ ?>
								<tr><td><?= ++$x?></td><td><?= $success[$i]?></td><td><?= $from;?></td><td><?= $status[$i]?></td></tr>
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


?>

	<div class="col-md-8 col-md-offset-2">
		<form action="<?= $_SERVER['PHP_SELF'];?>" method="post" autocomplete="off" enctype="multipart/form-data" id="testing">
		    <div class="form-group">
		   		 <label for="send_to" class="control-label" style="color: #fff;">Send To (To Send bulk use comma separation) *</label>
				 <input type="text" class="form-control" name="send_to" required="required" id="send_to" placeholder="Please Enter Numbers *">
		    </div>
		    <div class="form-group">
		   		 <label for="send_from" class="control-label" style="color: #fff;">Send Number *</label>
				 <input type="input" id="send_from" class="form-control" name="send_from" placeholder="Please Enter Send Number *" required=""  maxlength="11">
		    </div>
		    <div class="form-group">
		   		 <label for="message" class="control-label" style="color: #fff;">Message *</label>
				 <textarea rows="5" id="message" class="form-control" id="message" name="message" maxlength="700" placeholder="Please Enter Message *"></textarea>
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
		var send_to = $('#send_to').val().trim();
		var message = $('#message').val().trim();
		var send_from = $('#send_from').val().trim();
		if(Boolean(send_to)==false)
		{
			alert('PLease Enter Numbers');
			$('#send_to').val('').focus();
			return false;
		}
		if(Boolean(send_from)==false)
		{
			alert('PLease Enter Send Number');
			$('#send_from').val('').focus();
			return false;
		}
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