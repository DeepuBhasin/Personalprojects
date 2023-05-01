<?php
include_once('Models/config.php');
require_once('Models/Map.php');
require_once('Models/ChargerData.php');
require_once('Models/Pagination.php');

if (isset($_GET['nearest'])) {
    $locationObj = new Map($pdo);

  $allChargersList = $locationObj->getAllNearbyChargerLocation($_GET['lat'], $_GET['long']);
  $allMarkers = [];
  if (!empty($allChargersList)) {
    foreach ($allChargersList as $charger) {
      $allMarkers[] = ['lat' => $charger['lat'], 'long' => $charger['lng'], 'price' => $charger['price'], 'loc' => $charger['loc']];
    }
  }

  echo json_encode(['status' => 'success', 'allMarkers' => $allMarkers]);
  exit;
}
require_once('Views/nearYou.phtml');

?>