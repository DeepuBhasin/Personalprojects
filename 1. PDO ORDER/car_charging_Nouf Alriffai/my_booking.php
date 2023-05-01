<?php
include_once('Models/config.php');
require_once('Models/Booking.php');
require_once('Models/BookingData.php');
$bookingObj = new Booking($pdo);

if (empty($_SESSION['uid'])) {
    header('location:logout.php');
}

$view = new stdClass();
$dataSet = [];
if (isset($_GET['charger_id'])) {
    $bookingList = $bookingObj->myChargerBooking($_GET['charger_id']);
    if (!empty($bookingList)) {
        foreach ($bookingList as $list) {
            $dataSet[] = new BookingData($list);
        }
    }
    $view->bookingList = $dataSet;
    require_once('Views/my_booking.phtml');
    exit;
} else {
    $bookingList = $bookingObj->myBooking($_SESSION['uid']);
    if (!empty($bookingList)) {
        foreach ($bookingList as $list) {
            $dataSet[] = new BookingData($list);
        }
    }
    $view->bookingList = $dataSet;
    require_once('Views/my_booking.phtml');
    exit;
}
?>
