
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

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="https://www.fiverr.com/henrrygoels?up_rollout=true">Henrry Profile</a></li>
			</ul>
			
		</div><!-- /.navbar-collapse -->
	</div>
</nav>

<div class="container">
<?php
  if(isset($_POST['send']))
  {
    $number=explode(",",$_POST['send_to']);
    $message=urlencode(stripcslashes(htmlentities(trim($_POST['message']))));
    
    if(empty($message) && empty($number[0]))
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
    else{
			for($x=0;$x<count($number);$x++)
			{	

				$url='https://platform.clickatell.com/messages/http/send?apiKey=HuLwPhRpTTaneCW0eFyuKQ==&to='.$number[$x].'&content='.$message;
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
					
					$numberFile=$number[$x];
					$data=fopen('file.txt','a');
					fwrite($data,"$numberFile \n");							
					fclose($data);
		        }	
			}		
			if(isset($yes))
			{
				?>
				<div class="row">
					<div class="col-md-8 col-lg-offset-2">
						<div class="alert alert-success msg">
							Program Execute Successfully
							<script type="text/javascript">
								setTimeout(function(){$('.msg').hide();},3000);
							</script>
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
			<!-- * (use comma separation for bulk SMS) -->
	           <label for="send_to" class="control-label" style="color: #fff;">Send To (use comma separation for bulk SMS)</label>
	         <input id="send_to" class="form-control" id="send_to" name="send_to" placeholder="Please Enter Numbers *">
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
    var message = $('#message').val().trim();
    var send_to = $('#send_to').val().trim();
    if(Boolean(send_to)==false)
    {
      alert('PLease Enter Number');
      $('#send_to').val('').focus();
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