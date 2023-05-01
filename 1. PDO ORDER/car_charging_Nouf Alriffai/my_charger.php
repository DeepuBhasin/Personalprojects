<?php
include_once('Models/config.php');
require_once('Models/Charger.php');
require_once('Models/ChargerData.php');
require_once('Models/Pagination.php');

$chargerObj = new Charger($pdo);
if (strlen($_SESSION['uid']) == "") {
    header('location:logout.php');
}

$limit = 5;
if (isset($_GET["page"])) {
    $page  = $_GET["page"];
} else {
    $page = 1;
};
$start_from = ($page - 1) * $limit;

$chargerList = $chargerObj->getMyChargers($_SESSION['uid'], $start_from , $limit);
$total_records = count($chargerObj->getMyChargers($_SESSION['uid'], 0 , 0));

$total_pages = ceil($total_records / $limit);

$myChargerPage = true;

$view = new stdClass();
$dataSet = [];
if (!empty($chargerList)) {
    foreach ($chargerList as $list) {
        $dataSet[] = new ChargerData($list);
    }
}
$view->chargerList = $dataSet;
$view->pagination = new Pagination($total_pages);

require_once('Views/list.phtml');
?>
