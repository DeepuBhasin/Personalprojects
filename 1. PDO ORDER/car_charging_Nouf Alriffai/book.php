<?php
// include Function  file
include_once('Models/config.php');
require_once('Models/Charger.php');
require_once('Models/Booking.php');
$chargerObj = new Charger($pdo);
$bookingObj = new Booking($pdo);

if (empty($_SESSION['uid'])) {
    header('location:logout.php');
}

if (isset($_POST['submit'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $user_id = $_SESSION['uid'];
    $charger_id = $_POST['charger_id'];
    $sql = $bookingObj->addbooking($start_date, $end_date, $user_id, $charger_id);
    if ($sql) {
        $_SESSION['success'] = "Charger booking added successfully";
        header('location:list.php');
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again";
        header("location:book.php?charger_id=$charger_id");
    }
} else {
    $charger = $chargerObj->getSingleChargerData($_GET['charger_id']);
}

require_once('Views/book.phtml');
