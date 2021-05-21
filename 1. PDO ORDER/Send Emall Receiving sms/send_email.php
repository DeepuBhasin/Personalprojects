<?php
session_start();
if(!isset($_SESSION['user_name']))
{
	header("location:index.php");
}
include_once('database.php');
if(isset($_GET['id']))
{
  if(empty($_GET['id']))
  {
    header("location:view.php?message=empty_fail");
  }
  else
  {
    $id=base64_decode($_GET['id']);
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $DBH->prepare("SELECT r.*,d.user_id,d.email_id,d.status as user_status,d.user_limit FROM receive_data as r LEFT JOIN didww_user as d ON d.user_id=r.user_id  where r.status=:r_status and id=:id;"); // 

    $stmt->execute(['r_status'=>0,'id'=>$id]);
	if($stmt->rowCount()==1)
	    {
		 while($row = $stmt->fetch(PDO::FETCH_OBJ))
	        {
				if($row->user_status==0)
		          {
		          	header("location:view.php?message=user_fail");
		          }
		          else
		          {
		          		$stmt2 = $DBH->prepare("SELECT COUNT(id) as user_count FROM receive_data where user_id=:id and status=:status"); //
			        	$stmt2->execute(['id'=>$row->user_id,'status'=>1]);
			        	$row_user_count=$stmt2->fetch(PDO::FETCH_OBJ);
			        	
			        	$check=(int) $row->user_limit-(int) $row_user_count->user_count;
			        	if($check==0)
				        {
				        	
				        	  $row_id=$row->id;
					          $row_source = $row->source;
					          $row_dest = $row->dest;
					          $row_message = $row->message;
					          $row_time= $row->receive_time;

					          $row_email_id=$row->email_id;
							  $subject ="Email Limit Over Notification";

				              $message="Dear User, \n\r \n\r  <br/> <br/> Your Email Limit is over for Reveicing Emails please contact cutomer care. \n\r \n\r <br/> <br/> Thank you.";
				              $send = mail($row_email_id,$subject,$message,$headers);

				              if($send)
				              {
				              		header("location:view.php?message=user_over_fail");
				        			
				              }
				              else
				              {
				              		// echo "no ok";
				              		header("location:view.php?message=database_fail");
				              }			

							}
							else
							{
								$row_id=$row->id;
						          $row_source = $row->source;
						          $row_dest = $row->dest;
						          $row_message = $row->message;
						          $row_time= $row->receive_time;

						          $row_email_id=$row->email_id;
								  $subject ="Infromation Message.";

					              $message="Source : $row_source. \r\n <br/> \r\n <br/>  Destination : $row_dest. \r\n <br/> \r\n <br/> Message : $row_message. \r\n <br/> \r\n <br/> Receving Time : $row_time.";
					              $send = mail($row_email_id,$subject,$message,$headers);

					              if($send)
					              {
					              		$stmt1 = $DBH->prepare("UPDATE receive_data set status=:status where id=:id"); // 
										$stmt1->execute(['status'=>1,'id'=>$row_id]);
										// echo "ok";
										header("location:view.php?message=success");
					              }
					              else
					              {
					              		// echo "no ok";
					              		header("location:view.php?message=database_fail");
					              }
							}
						}	
	        }
	    }
	    else
	    {
	    	header("location:view.php?message=already_fail");
	    }	
	 
  }  
} 
else
{
  header("location:view.php?message=fail");
} 

?>