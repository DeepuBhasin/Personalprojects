<?php
session_start();
include_once('database.php');

if(isset($_POST['add_sms']))
{
	$full_name=addslashes(htmlentities(trim($_POST['full_name'])));
	$actual_number=$mobile_number=addslashes(htmlentities(trim($_POST['mobile_number'])));
	$remarks=addslashes(htmlentities(trim($_POST['remarks'])));
	
	$query=mysqli_query($con,"SELECT * FROM user where actual_number='$actual_number'");
	if(mysqli_num_rows($query)==0)
	{
		$country_code=$_POST['country_id'];
		$query=mysqli_fetch_array(mysqli_query($con,"SELECT phonecode FROM country where id=$country_code"))['phonecode'];
	
		$mobile_number=$query.$mobile_number;

		$check=$insert=mysqli_query($con,"INSERT into user values(null,'$full_name','$mobile_number',$country_code,'$actual_number','$remarks',1,{$_SESSION['id']},'$get_time',null)");
		if($check)
		{
			header("location:add_contact_sms.php?page=index&color=success&message=$full_name ($actual_number) Contact Added Successfully");
		}
		else
		{
			header("location:add_contact_sms.php?page=index&color=danger&message=Database Problem");
		}	
		
	}
	else
	{
		header("location:add_contact_sms.php?page=index&color=warning&message=Contact already Added");
	}


		
}
else if(isset($_GET['delete_customer_id']))
{
	$delete_customer_id = $_GET['delete_customer_id'];

	$x=mysqli_query($con,"UPDATE user set status=0 where user_id=$delete_customer_id");
		if($x)
		{
			header("location:view_contact_sms.php?page=index&color=success&message=Contect Deleted Successfully");
		}
		else
		{
			header("location:view_contact_sms.php?page=index&color=danger&message=Database Problem");
		}	
		
		
}	
else if(isset($_POST['update_customer']))
{
	
	$full_name=addslashes(htmlentities(trim($_POST['full_name'])));
	$actual_number=$mobile_number=addslashes(htmlentities(trim($_POST['mobile_number'])));
	$remarks=addslashes(htmlentities(trim($_POST['remarks'])));
	$country_code=$_POST['country_id'];
	$query=mysqli_fetch_array(mysqli_query($con,"SELECT phonecode FROM country where id=$country_code"))['phonecode'];
	$mobile_number=$query.$mobile_number;
	$user_id = $_POST['user_id'];


	$x=mysqli_query($con,"UPDATE user set full_name='$full_name',mobile_number='$mobile_number',country_code='$country_code',actual_number='$actual_number',remarks='$remarks',update_dt='$get_time' where user_id=$user_id");
	
	if($x)
	{
		$_SESSION['first_name']=$first_name;
		$_SESSION['last_name']=$last_name;
		header("location:view_contact_sms.php?page=index&color=success&message=$full_name ($actual_number) Contact Updated Successfully");
	}
	else
	{
		header("location:view_contact_sms.php?page=index&color=danger&message=Database Problem");
	}	
		
		
}

if(isset($_POST['update']))
{
	$first_name=stripcslashes(htmlentities(trim($_POST['first_name'])));
	$last_name=stripcslashes(htmlentities(trim($_POST['last_name'])));
	$x=mysqli_query($con,"UPDATE login set first_name='$first_name',last_name='$last_name' where id=".$_SESSION['id']);
		if($x)
		{
			$_SESSION['first_name']=$first_name;
			$_SESSION['last_name']=$last_name;
			header("location:dashboard.php?page=index&color=success&message=Profile Updated Successfully");
		}
		else
		{
			header("location:dashboard.php?page=index&color=danger&message=Database Problem");
		}	
		
		
}	
if(isset($_POST['update_password']))
{
	$old_password=md5(stripcslashes(htmlentities(trim($_POST['old_password']))));
	$new_password=md5(stripcslashes(htmlentities(trim($_POST['new_password']))));

	$query=mysqli_query($con,"SELECT * FROM login where password='$old_password' and id=".$_SESSION['id']);
	if(mysqli_num_rows($query)==1)
	{
		$x=$insert=mysqli_query($con,"UPDATE login set password='$new_password'where id=".$_SESSION['id']);
		if($x)
		{
			header("location:change_password.php?page=index&color=success&message=Password Updated Successfully");
		}
		else
		{
			header("location:change_password.php?page=index&color=danger&message=Database Problem");
		}
	}
	else
	{
		header("location:change_password.php?page=index&color=warning&message=Old Password do not match");
	}	
}	


?>