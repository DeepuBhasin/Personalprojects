<?php
require './classes/product.php';
if (isset($_POST['name'])) {
    $sku = strtolower($_POST['sku']);
    $name = $_POST['name'];
    $price = $_POST['price'];
    $typeSwitcher = $_POST['typeSwitcher'];
    $selected = json_encode($_POST['selected']);
    $pr->addProduct($sku, "INSERT INTO product_table VALUES (null, '$sku', '$name', '$price', '$typeSwitcher', '$selected')");
}
require './views/view-add-product.php';
