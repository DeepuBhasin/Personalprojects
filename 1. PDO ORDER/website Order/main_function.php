<?php
include_once('database.php');
// session_start();
if(isset($_POST['sign_in']))
{
	$now = new DateTime();
	$now->setTimezone(new DateTimezone('Asia/Calcutta'));
	$get_time= $now->format('Y-m-d H:i:s');
	$ipaddress= $_SERVER['SERVER_ADDR'];

	$email_id=stripcslashes(htmlentities(trim($_POST['email_id'])));
	$password=stripcslashes(htmlentities(trim($_POST['password'])));

	$email_id_code=mysqli_real_escape_string($con,strtolower($email_id));
	$password=md5(mysqli_real_escape_string($con,$password));

	$query=mysqli_query($con,"SELECT * FROM login WHERE email_id_code='$email_id_code' AND password='$password'");
	if(mysqli_num_rows($query)==1)
	{
		while($ab=mysqli_fetch_array($query))
		{
			session_start();
			$_SESSION=array(
				'id'=>$ab['id'],
				'first_name'=>$ab['first_name'],
				'email_id'=>$ab['email_id'],
				'login_time'=>$ab['login_time'],
				'login_address'=>$ab['login_address']);
			mysqli_query($con,"UPDATE login SET login_time='$get_time',login_address='$ipaddress'WHERE id=".$ab['id']);
			header("location:dashboard.php?page=index&color=success&message=".urlencode('Welcome To Management System'));
		}
	}
	else
	{
		header("location:index.php?page=index&color=danger&message=".urlencode('Invalid Email Id and Password'));
	}	

}
else if(isset($_POST['sign_up']))
{
	$email_id=stripcslashes(htmlentities(trim($_POST['email_id'])));
	$email_id_code=mysqli_real_escape_string($con,strtolower($email_id));
	
	$query=mysqli_query($con,"SELECT * FROM login WHERE email_id_code='$email_id_code'");
	if(mysqli_num_rows($query)==0)
	{
			$first_name=stripcslashes(htmlentities(trim($_POST['first_name'])));
			$last_name=stripcslashes(htmlentities(trim($_POST['last_name'])));
			$mobile_number=stripcslashes(htmlentities(trim($_POST['mobile_number'])));
			$password=stripcslashes(htmlentities(trim($_POST['password'])));
			$password=md5(mysqli_real_escape_string($con,$password));

			$x=mysqli_query($con,"INSERT INTO login(first_name,last_name,mobile_number,email_id,email_id_code,password) VALUES('$first_name','$last_name','$mobile_number','$email_id','$email_id_code','$password')");
			if($x)
			{
				header("location:index.php?page=index&color=success&message=".urlencode('User Added Successfully'));	
			}
			else
			{
				header("location:index.php?page=index&color=danger&message=".urlencode('Database Problem'));	
			}	
	}
	else
	{
		header("location:index.php?page=index&color=warning&message=".urlencode('User Already Added'));	
	}	
}
else
	{
		header("location:index.php?page=index&color=danger&message=".urlencode('Access Denied'));
	}	

?>