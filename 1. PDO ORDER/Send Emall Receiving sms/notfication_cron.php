<?php
	include_once('database.php');

    
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt1=$DBH->prepare("SELECT * FROM didww_user WHERE status=1 and limit_status=1;");

    $stmt1->execute();

    while($row=$stmt1->fetch(PDO::FETCH_OBJ))
    {
    	$full_name=$row->full_name;
    	$email_id=$row->email_id;
		$subject ="Reminder of Email Limit Over";
	    $message="Dear $full_name, \n\r \n\r  <br/> <br/> Your Email Limit is over for Reveicing Emails please contact cutomer care. \n\r \n\r <br/> <br/> Thank you.";
	     $send = mail($email_id,$subject,$message,$headers);

	  if($send)
	  {
	  		echo "Message : 200 OK Success. Notification.";
		}
	  else
	  {
	  		echo "Message : 404 OK Error. Notification.";
	  }

    }	
?>