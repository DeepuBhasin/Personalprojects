<?php

use Classes\ProductData;

require './classes/product.php';
require './classes/productData.php';

if (isset($_POST) && !empty($_POST)) {
    foreach ($_POST['product'] as $value) {
        $pr->deleteProduct("DELETE FROM product_table where id = $value;");;
    };
};

$view = new stdClass();
$productList = $pr->getProducts();

$productData = [];
if (!empty($productList)) {
    foreach ($productList as $d) {
        $productData[] = new ProductData($d);
    }
}
require './views/view-product-list.php';
