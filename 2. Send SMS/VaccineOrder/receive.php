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
  
  $x=mysqli_query($con,"INSERT into sms_history values(null,'$account_sid','$sid_received','$type','$send_to','$message_from','$body',$num_segments,'$status','$remarks','$method',$created_by,'$created_dt')");

  if($x)
  {
     if($body==1)
      {
        $message= "Thank you for taking your medication.";
      }else if ($body==2){
        $message= "Sorry that you skipped a dose.";
      }else {
        $message = "Please select a valid option. Time to take your medication. Select 1 to confirm or Select 2 to skip a dose.";
      }

      $api = curl_init("https://api.twilio.com/2010-04-01/Accounts/$sid/Messages.json");
      curl_setopt_array($api, array(
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_POST => 1,
          CURLOPT_HTTPHEADER => array("Authorization: Basic ".base64_encode($sid.':'.$auth)),
          CURLOPT_POSTFIELDS => array(
              'Body' =>$message,
              'To' => $send_to,
              'From' =>$message_from
          )
      ));

      $resp = curl_exec($api);
      $resp=json_decode($resp,true);
      
      if(isset($resp['sid']))
        {
          $account_sid=$resp['account_sid'];
          $sid_sent=$resp['sid'];
          $type='Automatic';
          $body=$message;
          $num_segments=$resp['num_segments'];
          $created_by=0;
          $created_dt=$get_time;
          $status="Sent";
          $method="automatic out";
          $remarks="Message Sent Successfully";
        }
        else
          {  
            $account_sid="Not Availabe";
            $sid_sent="Not Availabe";
            $type='Automatic';
            $body=$message;
            $num_segments=0;
            $created_by=0;
            $created_dt=$get_time;
            $status="Failed";
            $method="automatic out";
            $remarks=mysqli_real_escape_string($con,stripslashes(htmlentities(trim($resp['message']))));
          }
          
         $x=mysqli_query($con,"INSERT into sms_history values(null,'$account_sid','$sid_sent','$type','$send_to','$message_from','$body',$num_segments,'$status','$remarks','$method',$created_by,'$created_dt')");    
    }
}
else
{
  echo "<h1>Access Denied</h1>";
}  

?>