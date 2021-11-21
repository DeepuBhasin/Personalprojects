<?php
// empty value and expiration one hour before
$cookie_name = 'user_id';
$cookie_value = '';
$cookie_days = time() - 3600;
$path = '/';
setcookie($cookie_name, $cookie_value, $cookie_days, $path);
header('location:index.php');
