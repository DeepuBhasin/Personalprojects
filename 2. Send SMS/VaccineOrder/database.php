<?php
$con=mysqli_connect("localhost","root","","radzi_database");
if(!$con)
{
	die("<h2>Database is Not Connected</h2>");
}

$from_list = array(0=>'+18338580112');//Your Twilio Phone Number
$sid = 'ACa97ec5b67df9d5218763e446cbecab13';//Your Twilio API Account SID
$auth = '4f53279578749921b944dbe7868aaeb8';//Your Twilio API Account Auth Token

$now = new DateTime();
$now->setTimezone(new DateTimezone('Asia/Calcutta'));
$get_time= $now->format('Y-m-d H:i:s');


// $con=mysqli_connect("localhost","wavelinx_order","Deepu_9915099247","wavelinx_order");
?>