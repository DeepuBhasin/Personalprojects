<?php
$con = mysqli_connect('localhost','root','','pdodata');

$sql = "SELECT * FROM json_data_2 order by first_name ASC";

$query = mysqli_query($con,$sql);

$data = mysqli_fetch_all($query,MYSQLI_ASSOC);

$routue['route']=$data;

echo "<pre>";
print_r(json_encode($routue));

?>