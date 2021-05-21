
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
		
		if($_FILES["csv_file"]["size"]<=0)
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



			$filename=$_FILES["csv_file"]["tmp_name"];		
	 		if($_FILES["csv_file"]["size"] > 0)
			{
				$file = fopen($filename, "r");
				$rows=count($file);
				
				$x=0;
		        while (($getData = fgetcsv($file,10000, ",")) !== FALSE)
		        {
	 				$phone_number_list[$x]=$getData[0];
	 				$x++;
				}
			}
			var_dump($phone_number_list);
			exit;
			
		for ($i=0;$i<$x;$i++) 
		{ 
			
	      	$sid = 'ACebe73d08c191bceac793d4c5864a747a';
        	$auth = '065d18a9193f98cab2ccb887111ae926';
			
			$api = curl_init("https://api.twilio.com/2010-04-01/Accounts/$sid/Messages.json");
	        curl_setopt_array($api, array(
	            CURLOPT_RETURNTRANSFER => 1,
	            CURLOPT_POST => 1,
	            CURLOPT_HTTPHEADER => array("Authorization: Basic ".base64_encode($sid.':'.$auth)),
	            CURLOPT_POSTFIELDS => array(
	                'Body' =>$_POST['message'],
	                'To' => '+'.$phone_number_list[$i],
	                'From' => $from
	            )
	        ));
	    

	    
	    
	        $resp = curl_exec($api);
	        $resp=json_decode($resp, true);

	        if(isset($resp['sid']))
	        {
	        	 $success[$i]='+'.$phone_number_list[$i];
	        	 $status[$i]="Sent";
	        	 $yes=true;
	        }
	        else
	        {
	        	$success[$i]='+'.$phone_number_list[$i];
	        	$status[$i]="Failed";
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
								<th>Phone Number</th>
								<th>Sender Id</th>
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
			
		}	
	}
?>
	<div class="col-md-8 col-md-offset-2">
		<form action="<?= $_SERVER['PHP_SELF'];?>" method="post" autocomplete="off" enctype="multipart/form-data" id="testing">
		    <div class="form-group">
		   		 <label for="csv_file" class="control-label" style="color: #fff;">CSV File*</label>
				 <input type="file" name="csv_file" required="required" accept=".csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
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
		var message = $('#message').val().trim();
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