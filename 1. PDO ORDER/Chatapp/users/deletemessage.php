<?php
include('header.php');
if (isset($_GET['mid'])) {
    require './main.php';
    $mid = $_GET['mid'];
    $friend_id = $_GET['friend_id'];
    $response = $sendmessage->deleteMessage($mid);
    header("location:sendmessage.php?id=$friend_id&&message=".urlencode($response));
}
?>
