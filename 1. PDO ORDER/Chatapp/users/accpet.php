<?php
include('header.php');
if (isset($_GET['id'])) {
    require './main.php';
    $friend_list_id = $_GET['id'];
    $id = $_SESSION['login_user']['id'];
    $response = $sendfrinedrequest->acceptRequest($id, $friend_list_id);
    header("location:allreceivedrequest.php?id=$friend_list_id&&message=".urlencode($response));
}
?>