<?php

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .="From:inquiry@thehnc.org\r\n";
$headers .="Reply-To:inquiry@thehnc.org\r\n";
$headers .="Return-Path:inquiry@thehnc.org\r\n";
// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
$ok=mail("Deepinder999@gmail.com","My subject",$msg,$headers);
if($ok)
{
    echo "ok";
}
else
{
    echo "nyi";
}
?>