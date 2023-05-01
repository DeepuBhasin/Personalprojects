<?php
// include Function  file
include_once('Models/config.php');
require_once('Models/User.php');
$userObj = new User($pdo);
if (isset($_POST['signin'])) {
    // Posted Values
    $uname = $_POST['username'];
    $pasword = md5($_POST['password']);
    //Function Calling
    $userData = $userObj->signin($uname, $pasword);
    if (!empty($userData) && is_array($userData)) {
        $_SESSION['uid'] = $userData['id'];
        $_SESSION['fname'] = $userData['display_name'];
        $_SESSION['user_type'] = $userData['user_type'];

        $_SESSION['success'] = "Congratulation you successfully login";
        header('location:list.php');
    } else {
        $_SESSION['error'] = "Invalid details. Please try again";
        header('location:signin.phtml');
    }
}

require_once('Views/signin.phtml')
?>
