<?php
include_once('database.php');
if(isset($_GET['p_id']))
{
  
    $patient_id=$_GET['p_id'];
    $query=mysqli_query($con,"DELETE FROM patient where patient_id=$patient_id");
    if($query)
    {
      header("location:view_patient.php?page=index&color=success&message=Patient Deletd Successfully");
    }
    else
    {
      header("location:view_patient.php?page=index&color=danger&message=Database Problem");
    } 
   
}
else if(isset($_GET['d_id']))
{
    $doctor_id=$_GET['d_id'];
    $query=mysqli_query($con,"DELETE FROM doctor where doctor_id=$doctor_id");
    if($query)
    {
      header("location:view_doctor.php?page=index&color=success&message=Doctor Deletd Successfully");
    }
    else
    {
      header("location:view_doctor.php?page=index&color=danger&message=Database Problem");
    } 
   
}
else
{
  header("location:dashboard.php");
}  

?>