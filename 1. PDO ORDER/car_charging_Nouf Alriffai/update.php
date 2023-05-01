<?php
include_once('Models/config.php');
require_once('Models/Charger.php');
require_once('Models/ChargerData.php');

$chargerObj = new Charger($pdo);


if (isset($_POST['submit'])) {
    $loc = $_POST['loc'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $price = $_POST['price'];
    $charger_id = $_POST['charger_id'];

    //Function Calling
    $sql = $chargerObj->update($loc, $lat, $lng, $price, $charger_id);
    if ($sql) {
        $_SESSION['success'] = "Charge point updated successfull.";
        header('location:list.php');
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again";
        header("location:update.php?id=$id");
    }
} else {
    $view = new stdClass();
    $id = $_GET['id'];
    $charger = $chargerObj->getSingleChargerData($id);
    $view->charger = new ChargerData($charger);

}
require_once('Views/update_charger.phtml');
