<?php

namespace Classes;

use ProductAbstract;

require __DIR__ . '/Database.php';
require __DIR__ . '/ProductAbstract.php';

class Product extends ProductAbstract
{

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getProducts()
    {
        return $this->db->selectQuery("SELECT * FROM product_table ORDER BY id ASC");
    }

    public function addProduct(string $sku = '', string $query = '')
    {
        if ($query !== '') {
            $checkQuery = "SELECT * FROM product_table WHERE sku='$sku'";
            $check = $this->db->selectQuery($checkQuery);
            if (empty($check)) {
                $execute = $this->db->insertQuery($query);

                if ($execute > 0) {
                    echo '<script>alert("Product added successfully with SKU : ' . $sku . '"); window.location.replace("index.php");</script>';
                    exit;
                } else {
                    echo '<script>alert("Database Problem");</script>';
                }
            } else {
                echo '<script>alert("Product is Already Exist with SKU : ' . $sku . '");</script>';
            }
        }
    }
    public function deleteProduct(string $query = '')
    {
        if ($query != '') {
            $this->db->deleteQuery($query);
        }
    }
}

$pr = new Product($db);
