<?php
	include_once('database.php');

    
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt1=$DBH->prepare("SELECT DISTINCT(r.dest),d.* FROM receive_data as r INNER JOIN didww_user as d ON d.user_id=r.user_id WHERE d.status=1 and r.status=0 and d.limit_status=0");

    $stmt1->execute();

    while($row_of_stmt1=$stmt1->fetch(PDO::FETCH_OBJ))
    {

    	echo "User Number : ".$row_of_stmt1->dest."<br/>";
    	echo "Total Limit : ".$row_of_stmt1->user_limit."<br/>";

    	$stmt2=$DBH->prepare("SELECT COUNT(id) as message_in_database FROM receive_data WHERE dest=:destination_number and status=:status");
    	$stmt2->execute(['destination_number'=>$row_of_stmt1->dest,'status'=>1]);
    	$message_in_database=$stmt2->fetch(PDO::FETCH_OBJ)->message_in_database;

    	echo "Total Message In database : ".$message_in_database."<br/>";

    	echo "Total New Message Can Receive : ".$total_send=$row_of_stmt1->user_limit-$message_in_database."<br/>";





    	$stmt2=$DBH->prepare("SELECT COUNT(id) as message_received FROM receive_data WHERE dest=:destination_number and status=:status");
    	$stmt2->execute(['destination_number'=>$row_of_stmt1->dest,'status'=>0]);
    	$message_received=$stmt2->fetch(PDO::FETCH_OBJ)->message_received;

    	echo "Total New Message in database : ".$message_received."<br/>";


		if($total_send>$message_received)
    	{
    		$for_loop_count=$message_received;
    	}
    	else
    	{
    		$for_loop_count=$total_send;
    	}

    	echo "For Loop will excecute : ".$for_loop_count."<br/>";	


    	echo "Messsage Left to receive  : ".$Notification_check=$row_of_stmt1->user_limit-$message_received-$message_in_database."<br/>";


    	echo "<br/>";

    	$stmt3=$DBH->prepare("SELECT r.*,d.email_id,d.full_name FROM receive_data as r INNER JOIN didww_user as d ON d.user_id=r.user_id WHERE r.user_id=:user_id and r.status=0 ORDER BY r.id ASC");
    	  $stmt3->execute(['user_id'=>$row_of_stmt1->user_id]);

    	  // echo "<pre>";

    	if($stmt3->rowCount()>0)
		{  
	    	for($i=1;$i<=$for_loop_count;$i++)
	    	{
    			$data=$stmt3->fetch(PDO::FETCH_OBJ);
				$row_full_name=$data->full_name;
				$row_id=$data->id;
				$row_source=$data->source;
				$row_dest=$data->dest;
				$row_message=$data->message;
				$row_receive_time=$data->receive_time;
				$row_receive_email_id=$data->email_id;
				$message="Dear $row_full_name,\r\n <br/> \r\n <br/> Source : $row_source. \r\n <br/> \r\n <br/>  Destination : $row_dest. \r\n <br/> \r\n <br/> Message : $row_message. \r\n <br/> \r\n <br/> Receving Time : $row_receive_time.";
				$subject ="Infromation Message.";
				$send = mail($row_receive_email_id,$subject,$message,$headers);

				if($send)
				{
					$stmt4 = $DBH->prepare("UPDATE receive_data set status=:status where id=:id"); // 
					$stmt4->execute(['status'=>1,'id'=>$row_id]);
					echo "Message : 200 OK Success. Email.";
				}
				else
				{
					echo "Message : 404 OK Error. Email.";
				}

				if($i==$for_loop_count)
				{
					if($Notification_check<=0)
					{	
						 $subject ="Email Limit Over Notification";
	                     $message="Dear $row_full_name, \n\r \n\r  <br/> <br/> Your Email Limit is over for Reveicing Emails please contact cutomer care. \n\r \n\r <br/> <br/> Thank you.";
			             $send = mail($row_receive_email_id,$subject,$message,$headers);

						if($send)
						{
								$stmt4 = $DBH->prepare("UPDATE didww_user set limit_status=:limit_status where user_id=:user_id");  
							$stmt4->execute(['limit_status'=>1,'user_id'=>$row_of_stmt1->user_id]);
							
							echo "Message : 200 OK Success. Notification.";
						}
						else
						{
							echo "Message : 404 OK Error. Notification.";
						}	
					}

				}
			}
		// 	echo "</pre><br/>";
		// echo "<br/>";
		}
  

		
	}	 
?>