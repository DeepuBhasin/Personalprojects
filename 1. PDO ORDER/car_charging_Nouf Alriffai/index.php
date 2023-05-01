<?php
// include Function  file
include_once('Models/config.php');

require_once('Models/User.php');
$userObj = new User($pdo);
if (isset($_POST['submit'])) {
    $display_name = $_POST['fullname'];
    $user_name = $_POST['username'];
    $password = md5($_POST['password']);
    $user_type = $_POST['user_type'];
    //Function Calling
    $sql = $userObj->registration($display_name, $user_name, $password, $user_type);
    if ($sql) {
        $_SESSION['success'] = "Congratulation you successfully signup";
        header('location:signin.php');
    } else {
        $_SESSION['error'] = "something went wrong";
        header('location:index.php');
    }
}
require_once('Views/index.phtml');
