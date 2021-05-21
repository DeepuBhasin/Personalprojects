<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$databaseName = 'itech3108_30342987_a1';

$con = mysqli_connect($hostname,$username,$password,$databaseName);

if(!$con){
	die('<h1>DataBase is not connected</h1>');
}
?>