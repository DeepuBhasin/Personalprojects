<?php
$SMS_SRC=$_GET['SMS_SRC'];
$SMS_DST=$_GET['SMS_DST'];
$SMS_TIME=$_GET['SMS_TIME'];
$SMS_TEXT=$_GET['SMS_TEXT'];

if(isset($SMS_SRC) && isset($SMS_SRC) && isset($SMS_SRC) && isset($SMS_SRC))
{
	if(!empty($SMS_SRC) && !empty($SMS_SRC) && !empty($SMS_SRC) && !empty($SMS_SRC))
	{
	    include_once('database.php');
	    
		try 
		{
		
			$SMS_SRC=stripcslashes(htmlspecialchars(trim(urldecode($SMS_SRC))));
			$SMS_DST=stripcslashes(htmlspecialchars(trim(urldecode($SMS_DST))));
			$SMS_TEXT=stripcslashes(htmlspecialchars(trim(base64_decode(urldecode($SMS_TEXT)))));
			$SMS_TIME=stripcslashes(htmlspecialchars(trim(urldecode($SMS_TIME))));
			
            $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$DBH->beginTransaction();


			$stmt = $DBH->prepare("SELECT user_id FROM didww_user where user_number=:SMS_DST"); // 
                                
			//Assigning Values to parameters  
			$stmt->execute(['SMS_DST'=>$SMS_DST]);

			if($stmt->rowCount()>0)
			{
				 while($row = $stmt->fetch(PDO::FETCH_OBJ))
			    {
			    	$user_id=$row->user_id;
				}

				// binding Parameters and provide name to parameters 
				$stmt = $DBH->prepare("INSERT into receive_data(source,dest,message,receive_time,status,user_id) Values(:source,:dest,:message,:receive_time,:status,:user_id)"); // 
		    	
		    	//Assigning Values to parameters  
		    	$stmt->execute(['source'=>$SMS_SRC,'dest'=>$SMS_DST,'message'=>$SMS_TEXT,'receive_time'=>$SMS_TIME,'status'=>0,'user_id'=>$user_id]);

		    		
			}
			else
			{
				$stmt = $DBH->prepare("INSERT into receive_data(source,dest,message,receive_time,status) Values(:source,:dest,:message,:receive_time,:status)"); // 
		    	
		    	//Assigning Values to parameters  
		    	$stmt->execute(['source'=>$SMS_SRC,'dest'=>$SMS_DST,'message'=>$SMS_TEXT,'receive_time'=>$SMS_TIME,'status'=>0]);
			} 

			$DBH->commit();
			echo "200 OK";                               

			
	    }
		catch(PDOException $e)
		    {
		    	$DBH->rollback();
		    	echo "Error: " . $e->getMessage();
		    }
		$conn = null;

	}
	else
	{
		echo "<h1>Please Enter Values in Parameters</h1>";
	}	
}
else
{
	echo "<h1>ACCESS DENIED</h1>";

}		


?>