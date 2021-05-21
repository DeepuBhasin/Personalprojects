<?php
$con=mysqli_connect("localhost","root","","testing");
mysqli_query($con,"INSERT into ok(data,created_dt) values('1',NOW())");
?>