<?php 
include_once('db.php');
if(!isset($_POST['login']))
{
   header("location:index.php?id=danger&message=".urlencode("Access Denied."));
   exit;
}
session_start();
$email=mysqli_real_escape_string($con,strtolower($_POST['email']));
$password=mysqli_real_escape_string($con,$_POST['password']);
$query=mysqli_query($con,"SELECT * from account where email='$email' and password='$password'");
if(mysqli_num_rows($query)==1)
{ 
  while($row=mysqli_fetch_array($query))
   {
      
      if($row['type']==1)
       {
         $_SESSION['admin_id']=$row['id'];
         $_SESSION['admin_full_name']=$row['full_name'];
         $_SESSION['admin_email']=$row['email'];
         $_SESSION['admin_type']=$row['type'];
         header("location:admin/");
       }
       else if($row['type']==0)
       {
          $_SESSION['user_id']=$row['id'];
         $_SESSION['user_full_name']=$row['full_name'];
         $_SESSION['user_email']=$row['email'];
         $_SESSION['user_type']=$row['type'];
          header("location:user/");
       } 
   } 
   exit;
  
}	
else
{
  header("location:index.php?id=danger&message=".urlencode("Invalid Email Address/Password."));
} 
?>