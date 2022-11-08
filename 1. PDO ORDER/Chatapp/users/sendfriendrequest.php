<?php
include('header.php');
if (isset($_GET['id'])) {
    require './main.php';
    $friend_id = $_GET['id'];
    $id = $_SESSION['login_user']['id'];
    $response = $sendfrinedrequest->sendRequest($id, $friend_id);
    header("location:viewfriendprofile.php?id=$friend_id&&message=".urlencode($response));
}
?>
