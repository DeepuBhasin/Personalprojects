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
if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $chargerList = $chargerObj->getSearchData($query, $start_from, $limit);
    $total_records = count($chargerObj->getAllSearchData($query));
} else {
    $chargerList = $chargerObj->getChargerData($start_from, $limit);
    $total_records = count($chargerObj->totalChargers());
}

$view = new stdClass();
$dataSet = [];
if (!empty($chargerList)) {
    foreach ($chargerList as $list) {
        $dataSet[] = new ChargerData($list);
    }
}
$view->chargerList = $dataSet;

$total_pages = ceil($total_records / $limit);
$view->pagination = new Pagination($total_pages, $query ?? '');
// print_r($view->total_pages);die;
require_once('Views/list.phtml');
