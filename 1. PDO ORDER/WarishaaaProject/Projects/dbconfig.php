<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "tech3740";
$conn = @mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die('<h1>Database Connection Error : ' . mysqli_connect_error() . '</h1>');
}
