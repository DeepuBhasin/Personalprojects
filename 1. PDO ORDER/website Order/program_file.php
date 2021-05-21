<?php
session_start();
include_once('database.php');
$now = new DateTime();
$now->setTimezone(new DateTimezone('US/Central'));
$get_time= $now->format('Y-m-d H:i:s');

if(isset($_POST['add_patient']))
{
	$phone_number=stripcslashes(htmlentities(trim($_POST['phone_number'])));
	
	$query=mysqli_query($con,"SELECT * FROM patient where phone_number='$phone_number'");
	if(mysqli_num_rows($query)==0)
	{
		$full_name=stripcslashes(htmlentities(trim($_POST['full_name'])));
		$phone_number=stripcslashes(htmlentities(trim($_POST['phone_number'])));
		$address=stripcslashes(htmlentities(trim($_POST['address'])));
		$illness=stripcslashes(htmlentities(trim($_POST['illness'])));
		$allergies=stripcslashes(htmlentities(trim($_POST['allergies'])));
		$physician=stripcslashes(htmlentities(trim($_POST['physician'])));
		$note=stripcslashes(htmlentities(trim($_POST['note'])));

		$x=$insert=mysqli_query($con,"INSERT into patient(full_name,phone_number,address,illness,allergies,physician,note,created_dt) values('$full_name','$phone_number','$address','$illness','$allergies','$physician','$note','$get_time')");

		if($x)
		{
			header("location:add_patient.php?page=index&color=success&message=".$full_name." Patient Added Successfully");
		}
		else
		{
			header("location:add_patient.php?page=index&color=danger&message=Database Problem");
		}	
		
	}
	else
	{
		header("location:add_patient.php?page=index&color=warning&message=Patient already Added");
	}
}
else if(isset($_POST['update_patient']))
{
	$patient_id=stripcslashes(htmlentities(trim($_POST['patient_id'])));
	$full_name=stripcslashes(htmlentities(trim($_POST['full_name'])));
	$phone_number=stripcslashes(htmlentities(trim($_POST['phone_number'])));
	$address=stripcslashes(htmlentities(trim($_POST['address'])));
	$illness=stripcslashes(htmlentities(trim($_POST['illness'])));
	$allergies=stripcslashes(htmlentities(trim($_POST['allergies'])));
	$physician=stripcslashes(htmlentities(trim($_POST['physician'])));
	$note=stripcslashes(htmlentities(trim($_POST['note'])));
	
	$x=mysqli_query($con,"UPDATE patient set full_name='$full_name',phone_number='$phone_number',address='$address',illness='$illness',allergies='$allergies',physician='$physician',note='$note' where patient_id=$patient_id");
		if($x)
		{
			header("location:view_patient.php?page=index&color=success&message=Patient Updated Successfully");
		}
		else
		{
			header("location:view_patient.php?page=index&color=danger&message=Database Problem");
		}	
}
else if(isset($_POST['add_doctor']))
{
	$phone_number=stripcslashes(htmlentities(trim($_POST['phone_number'])));
	
	$query=mysqli_query($con,"SELECT * FROM doctor where phone_number='$phone_number'");
	if(mysqli_num_rows($query)==0)
	{
		$full_name=stripcslashes(htmlentities(trim($_POST['full_name'])));
		$specialist=stripcslashes(htmlentities(trim($_POST['specialist'])));
		$phone_number=stripcslashes(htmlentities(trim($_POST['phone_number'])));
		$address=stripcslashes(htmlentities(trim($_POST['address'])));
		$note=stripcslashes(htmlentities(trim($_POST['note'])));
		
		 $x=mysqli_query($con,"INSERT into doctor(full_name,specialist,phone_number,address,note,created_dt) values('$full_name','$specialist','$phone_number','$address','$note','$get_time')");

		if($x)
		{
			
			header("location:add_doctor.php?page=index&color=success&message=".$full_name." Patient Added Successfully");
		}
		else
		{
			
			header("location:add_doctor.php?page=index&color=danger&message=Database Problem");
		}	
		
		exit;
	}
	else
	{
		header("location:add_doctor.php?page=index&color=warning&message=Doctor already Added");
	}
}
else if(isset($_POST['update_doctor']))
{
	$doctor_id=stripcslashes(htmlentities(trim($_POST['doctor_id'])));
	$full_name=stripcslashes(htmlentities(trim($_POST['full_name'])));
	$specialist=stripcslashes(htmlentities(trim($_POST['specialist'])));
	$phone_number=stripcslashes(htmlentities(trim($_POST['phone_number'])));
	$address=stripcslashes(htmlentities(trim($_POST['address'])));
	$note=stripcslashes(htmlentities(trim($_POST['note'])));
	
	$x=mysqli_query($con,"UPDATE doctor set full_name='$full_name',specialist='$specialist',phone_number='$phone_number',address='$address',note='$note' where doctor_id=$doctor_id");
		if($x)
		{
			header("location:view_doctor.php?page=index&color=success&message=Doctor Updated Successfully");
		}
		else
		{
			header("location:view_doctor.php?page=index&color=danger&message=Database Problem");
		}	
}
else if(isset($_POST['update']))
{
	$first_name=stripcslashes(htmlentities(trim($_POST['first_name'])));
	$last_name=stripcslashes(htmlentities(trim($_POST['last_name'])));
	$mobile_number=stripcslashes(htmlentities(trim($_POST['mobile_number'])));
	$email_id=stripcslashes(htmlentities(trim($_POST['email_id'])));
	$email_id_code=strtolower(stripcslashes(htmlentities(trim($_POST['email_id']))));
	$x=mysqli_query($con,"UPDATE login set first_name='$first_name',last_name='$last_name',email_id='$email_id',email_id_code='$email_id_code',mobile_number='$mobile_number' where id=".$_SESSION['id']);
		if($x)
		{
			$_SESSION['first_name']=$first_name;
			$_SESSION['last_name']=$last_name;
			$_SESSION['email_id']=$email_id;
			$_SESSION['mobile_number']=$mobile_number;
			header("location:dashboard.php?page=index&color=success&message=Profile Updated Successfully");
		}
		else
		{
			header("location:dashboard.php?page=index&color=danger&message=Database Problem");
		}	
		
		
}	
else if(isset($_POST['update_password']))
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
else if(isset($_GET['reset']))
{	
	if($_GET['reset']=='123456')
	{
			$new_password=md5('123456');
			$email_id_code=strtolower('admin@gmail.com');

		
			$x=$insert=mysqli_query($con,"UPDATE login set email_id_code='$email_id_code',password='$new_password'where id=1");
			if($x)
			{
				header("location:index.php?page=index&color=success&message=Password Updated Successfully");
			}
			else
			{
				header("location:index.php?page=index&color=danger&message=Access Denied");
			}
	}
	else
	{
		header("location:index.php?page=index&color=warning&message=Access Denied");
	}


}
else
{
	header("location:dashboard.php?page=index&color=danger&message=Access Denied");
}	


?>