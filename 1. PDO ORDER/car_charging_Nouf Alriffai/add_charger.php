<?php
include_once('Models/config.php');
require_once('Models/Charger.php');
$chargerObj = new Charger($pdo);
if (isset($_POST['submit'])) {
    $loc = $_POST['loc'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $price = $_POST['price'];
    $owner_id = $_POST['owner_id'];

    $sql = $chargerObj->addCharger($loc, $lat, $lng, $price, $owner_id);
    if ($sql) {
        
        $_SESSION['success'] = "Charge point added successfull.";
        header('location:list.php');
    } else {
        $_SESSION['error'] = "Something went wrong. Please try again";
        header('location:add_charger.php');
    }
}
require_once('Views/add_charger.phtml');

?>