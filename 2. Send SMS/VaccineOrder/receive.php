<?php
include_once('database.php');
if(isset($_GET['MessageSid']) && !empty($_GET['MessageSid']))
{
  $account_sid=urldecode($_GET['AccountSid']);
  $sid_received=urldecode($_GET['MessageSid']);
  $type='Received';
  $send_to='+'.urldecode($_GET['From']);
  $message_from='+'.urldecode($_GET['To']);
  $body=urldecode($_GET['Body']);
  $num_segments=urldecode($_GET['NumSegments']);
  $created_by=0;
  $created_dt=$get_time;
  $status="Received";
  $method="reply";
  $remarks="Message received Successfully";

  // $message=$account_sid.'$$'.$sid.'$$'.$type.'$$'.$send_to.'$$'.$message_from.'$$'.$body.'$$'.$num_segments.'$$'.$created_by.'$$'.$created_dt.'$$'.$status.'$$'.$method.'$$'.$remarks;
  // $myfile = fopen("body.txt", "w") or die("Unable to open file!");
  // fwrite($myfile,$message);
  // fclose($myfile);
  
  mysqli_query($con,"INSERT into sms_history values(null,'$account_sid','$sid_received','$type','$send_to','$message_from','$body',$num_segments,'$status','$remarks','$method',$created_by,'$created_dt')");
}
else
{
  echo "<h1>Access Denied</h1>";
}  

?>