<?php
$con=mysqli_connect("localhost","root","","radzi_database");
if(!$con)
{
	die("<h2>Database is Not Connected</h2>");
}

$from_list = array(0=>'+13187688521');//Your Twilio Phone Number
$sid = 'AC314b47b9036115b70d53fe5d9001ba31';//Your Twilio API Account SID
$auth = '1580d14c3f8fa75c8b7ba4b838d0c85a';//Your Twilio API Account Auth Token

$now = new DateTime();
$now->setTimezone(new DateTimezone('Asia/Calcutta'));
$get_time= $now->format('Y-m-d H:i:s');


// $con=mysqli_connect("localhost","wavelinx_order","Deepu_9915099247","wavelinx_order");
?>