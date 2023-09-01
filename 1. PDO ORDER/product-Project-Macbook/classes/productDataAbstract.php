<?php

namespace Classes;

abstract class ProductDataAbstract
{
    private $id;
    private $sku;
    private $name;
    private $price;
    private $typeSwitcher;
    private $selected;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->sku = $data['sku'];
        $this->name = $data['name'];
        $this->price = $data['price'];
        $this->typeSwitcher = $data['typeSwitcher'];
        $this->selected = $data['selected'];
    }

    abstract public function getId();
    abstract public function getSku();
    abstract public function getName();
    abstract public function getPrice();
    abstract public function getTypeSwitcher();
    abstract public function getSelected();
}
