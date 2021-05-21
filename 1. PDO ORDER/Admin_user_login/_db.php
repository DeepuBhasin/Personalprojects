<?php
$dbhost = 'localhost';
$dbusr = 'root';
$dbpwd = '';
$dbname = 'pdologin';

$DBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusr, $dbpwd);
$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(!$DBH){
	die('<h1>Database is Not connected</h1>');
}

?>