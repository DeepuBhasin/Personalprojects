<?php 
include_once('../db.php');
session_start();
// echo "<pre>";
// print_r($_POST);
// exit;

function dataFilter($data=null,$con=null)
{
	return mysqli_real_escape_string($con,htmlspecialchars(trim($data)));
}

function get_time()
{
	$now = new DateTime();
	$now->setTimezone(new DateTimezone('Asia/Calcutta'));
	$get_time= $now->format('Y-m-d H:i:s');
	return $get_time;
}


//All Chanel Coding
if(isset($_POST['add']))
{
	$mac_adddress=dataFilter($_POST['mac_address'],$con);
	$customer_name=dataFilter($_POST['customer_name'],$con);
	$phone_number=dataFilter($_POST['phone_number'],$con);
	$start_sub=dataFilter($_POST['start_sub'],$con);
	$sub_type=dataFilter($_POST['sub_type'],$con);
	$created_dt = get_time();

	$end_sub = new DateTime($start_sub);
	$end_sub->add(new DateInterval('P'.$sub_type)); 
	$end_sub->modify('-3 days');
	$end_sub = $end_sub->format('Y-m-d');
	

	$query = "SELECT customer_id from customer_table where phone_number='$phone_number'";
	if(mysqli_num_rows(mysqli_query($con,$query))<=0)
	{
		$result=mysqli_query($con,"INSERT into customer_table values(null,'$mac_adddress','$customer_name','$phone_number','$start_sub','$end_sub','$sub_type',1,'$created_dt',null,0)");
		if($result)
			{
				header("location:add_chanel.php?id=success&message=".urlencode("<strong>".$_POST['phone_number']."</strong> Customer Added Successfully."));
			}
			else
			{
				header("location:add_chanel.php?id=danger&message=".urlencode("DataBase Problem. Please Try After Some Time."));
			}	

	}
	else
	{
		header("location:add_chanel.php?id=warning&message=".urlencode("<strong>".$_POST['phone_number']."</strong> Customer Already Added."));
	}
	exit;
	
}
if(isset($_GET['type']))
{
	if($_GET['type']=='delete_chanel')
	{
		$id=$_GET['delete_id'];
		mysqli_query($con,"DELETE FROM customer_table where customer_id='$id'");
		header("location:export_user.php?id=success&message=".urlencode("Customer Deleted Successfully."));
	}
}
if(isset($_POST['update_chanel']))
{
	$customer_id=dataFilter($_POST['customer_id'],$con);
	$mac_adddress=dataFilter($_POST['mac_address'],$con);
	$customer_name=dataFilter($_POST['customer_name'],$con);
	$phone_number=dataFilter($_POST['phone_number'],$con);
	$start_sub=dataFilter($_POST['start_sub'],$con);
	$sub_type=dataFilter($_POST['sub_type'],$con);
	$status=dataFilter($_POST['status'],$con);
	$created_dt = get_time();

	$end_sub = new DateTime(get_time());
	$end_sub->add(new DateInterval('P'.$sub_type)); 
	$end_sub->modify('-3 days');
	$end_sub = $end_sub->format('Y-m-d');
	

	$query = "UPDATE customer_table SET mac_adddress='$mac_adddress',customer_name='$customer_name',phone_number='$phone_number',start_sub='$start_sub',end_sub='$end_sub',sub_type='$sub_type',update_dt='$created_dt',`status`='$status' WHERE customer_id='$customer_id'";
	$result = mysqli_query($con,$query);
	if($result)
	{
		header("location:export_user.php?id=success&message=".urlencode("<strong>".$_POST['phone_number']."</strong> Customer Updated Successfully."));
	}
	else
	{
		header("location:export_user.php?id=danger&message=".urlencode("DataBase Problem. Please Try After Some Time."));
	}
	exit;
}
if(isset($_POST['change_password']))
{
	$old_pass=dataFilter($_POST['old_pass'],$con);
	$new_pass=dataFilter($_POST['new_pass'],$con);
	$my_id=$_SESSION['admin_id'];
	if(mysqli_num_rows(mysqli_query($con,"SELECT id from account where id='$my_id' and password='$old_pass'"))==1)
	{
		$result=mysqli_query($con,"UPDATE account set password='$new_pass' where id='$my_id'");
		header("location:change_password.php?id=success&message=".urlencode("Password Change Successfully."));
	}
	else
	{
		header("location:change_password.php?id=danger&message=".urlencode("Old Password Don not Match."));
	}

}
if(isset($_POST['add_message']))
{
	$textMessage= addslashes($_POST['textMessage']);
	$created_dt = get_time();
	$result=mysqli_query($con,"UPDATE message_table set message_text='$textMessage',created_dt='$created_dt' where message_id=1");
	if($result)
	{
		header("location:addMessage.php?id=success&message=".urlencode("Message Saved Successfully."));
	}
	else
	{
		header("location:addMessage.php?id=danger&message=".urlencode("Database Problem. Try after sometime.."));
	}	
	
}



?>