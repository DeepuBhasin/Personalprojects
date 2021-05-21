<?php
$con=mysqli_connect("localhost","root","","order");
if(!$con)
{
	die("<h2>Database is Not Connected</h2>");
}

$now = new DateTime();
$now->setTimezone(new DateTimezone('Asia/Calcutta'));
$get_time= $now->format('Y-m-d H:i:s');
?>