<?php
session_start();
if(!isset($_SESSION['user_name']))
{
	header("location:index.php");
}	
?>
<!DOCTYPE html>
<html>
<head>
	<title> View Details</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">

</head>

<body>
	<?php include_once('header.php');?>
	<div class="container">
			<br/>
			<br/>
            <div class="row">
				<center style="color:#000;">
                 <h1>RECEIVE DATA</h1>
                 <br/>
                 <?php
                 if(isset($_GET['message']))
                 {
                 	if($_GET['message']=='success')
                 	{
                 		?>
                 		<div class="alert alert-success">
			             	<strong>Success</strong> Email Send Successfully
			             </div>
                 		<?php
                 	}
                 	if($_GET['message']=='fail')
                 	{
                 		?>
                 		<div class="alert alert-danger">
			             	<strong>Error</strong> Access Denied
			             </div>
                 		<?php
                 	}
                 	if($_GET['message']=='already_fail')
                 	{
                 		?>
                 		<div class="alert alert-danger">
			             	<strong>Error</strong> Mail already Sent
			             </div>
                 		<?php
                 	}
                 	if($_GET['message']=='user_fail')
                 	{
                 		?>
                 		<div class="alert alert-danger">
			             	<strong>Error</strong> User Inactive
			             </div>
                 		<?php
                 	}
                 	if($_GET['message']=='database_fail')
                 	{
                 		?>
                 		<div class="alert alert-danger">
			             	<strong>Error</strong> Database Error
			             </div>
                 		<?php
                 	}
                 	if($_GET['message']=='user_over_fail')
                 	{
                 		?>
                 		<div class="alert alert-warning">
			             	<strong>Error</strong> Email Cannot Send beacuse User cross his Email Limit. Notification Email Sent to User for limit.
			             </div>
                 		<?php
                 	}	

                 }	
                 ?>
                    </center>
                    <br/>
                    <!-- <h1>Please Wait.</h1> -->
                    <table class="table-hover table-bordered table-responsive table-striped" id="table_id">
					<thead>
						<tr>
							<th>Sr. No</th>
							<th>Src</th>
							<th>Dest</th>
							<th>Message</th>
							<th>Time</th>
							<th>Email Id</th>
							<th>Provider Name</th>
							<th>User Status</th>
							<th>Send Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							try{
									include_once('database.php');
									$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
									
									// binding Parameters and provide name to parameters 
									$stmt = $DBH->prepare("SELECT r.*,d.user_id,d.email_id,d.status as user_status FROM receive_data as r LEFT JOIN didww_user as d ON d.user_id=r.user_id ORDER BY r.id DESC"); // 
							    	
							    	//Assigning Values to parameters  
							    	$stmt->execute();
							    	
							    	if($stmt->rowCount()>0)
							    	{
							    		$c=0;
							    		// set the resulting array to object
									    while($row = $stmt->fetch(PDO::FETCH_OBJ))
									    {
									    	?>
									    	<tr>
									    		<td><?= ++$c;?></td>
									    		<td><?= $row->source?></td>
									    		<td><?= $row->dest?></td>
									    		<td><?= $row->message?></td>
									    		<td><?= $row->receive_time?></td>
									    		<td><?php if(!empty($row->email_id)){echo $row->email_id;}else{echo "Not Available";} ?></td>
									    		<td><?= $row->provider_name?></td>
									    		<td><?php if($row->user_status==1){echo "Active"; }else{echo "Inactive";} ?></td>
									    		<td><?php if($row->status==1){echo "Sent"; }else{echo "Not Send";} ?></td>
									    		<?php
									    			 if($row->status==1)
									    			 { ?>
									    			 		<td><?= "Sent"?></td>
									    			 <?php
									    			 }
									    			 else
									    			 {
									    			 	if($row->user_status==1)
									    			 	{	
										    			   ?>
											    			 	<td><a href="send_email.php?id=<?= base64_encode($row->id);?>" class="btn btn-success">SEND EMAIL</a></td>	
											    			 <?php
									    				 }
									    				else
									    				{
									    					echo "<td>Option Not Available</td>";
									    				}
									    			  }	  
									    			 ?>
									    		
									    	</tr>
									    	<?php
									    }
							    	}
							    }
							   catch(PDOException $e)
							    {
							    	echo $e->getMessage();
							    } 	
						?>
					</tbody>
				</table>
			</div>
		</div>
	<?php include_once('footer.php');?>  
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script type="text/javascript">
	$(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>
</html>