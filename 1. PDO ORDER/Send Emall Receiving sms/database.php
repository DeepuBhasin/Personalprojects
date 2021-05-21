<?php
// $dbhost = "localhost";
// $dbusr = "database_order";
// $dbpwd = "Deepu_9915099247";
// $dbname = "database_order";



$dbhost = "localhost";
$dbusr = "root";
$dbpwd = "";
$dbname = "database_order";
$DBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusr, $dbpwd);

$now = new DateTime();
$now->setTimezone(new DateTimezone('Asia/Calcutta'));
$get_time= $now->format('Y-m-d H:i:s');


$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .="From:sms-forwarding@sms-forwarding.mycountrymobile.com\r\n";
$headers .="Reply-To:sms-forwarding@sms-forwarding.mycountrymobile.com\r\n";
$headers .="Return-Path:sms-forwarding@sms-forwarding.mycountrymobile.com\r\n";
$sent_from_email="sg2plcpnl0222.prod.sin2.secureserver.net";
?>

