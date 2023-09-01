<?php

use Classes\Database;

abstract class ProductAbstract
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    abstract public function getProducts();

    abstract public function addProduct(string $sku = '', string $query = '');

    abstract public function deleteProduct(string $query = '');
}
