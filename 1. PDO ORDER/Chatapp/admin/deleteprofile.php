<?php
include('header.php');
if (isset($_GET['id'])) {
    require './main.php';
    $id = $_GET['id'];
    $response = $admin ->deleteProfile($id);
    if(isset($_GET['page'])){
        header("location:searchfriend.php?message=".urlencode($response));
    } else {
        header("location:allusers.php?message=".urlencode($response));
    }
}
?>
