<?php
include_once('Models/config.php');
require_once('Models/ChargerData.php');
$view = new stdClass();

$lat = $_GET['lat'];
$long = $_GET['long'];
$price = $_GET['price'];
$data = ['lat' => $lat, 'lng' => $long, 'price' => $price];
$view->data = new ChargerData($data);

require_once('Views/leafletmap.phtml');


?>