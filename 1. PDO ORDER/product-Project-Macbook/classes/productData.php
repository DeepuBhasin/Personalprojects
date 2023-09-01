<?php

namespace Classes;

require __DIR__ . '/productDataAbstract.php';

class ProductData extends ProductDataAbstract
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

    public function getId()
    {
        return $this->id;
    }

    public function getSku()
    {
        return $this->sku;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getTypeSwitcher()
    {
        return  $this->typeSwitcher;
    }

    public function getSelected()
    {
        $t = json_decode($this->selected);

        if ($this->getTypeSwitcher() === "DVD") {
            $this->selected =   "Size :" . $t->dvd . " MB";
        } elseif ($this->getTypeSwitcher() === "Furniture") {

            $this->selected =    "Dimensions :" . $t->height . " x " . $t->width . " x " . $t->length;
        } else {

            $this->selected =   "Weight :" . $t->weight . " Kg";
        }
        return $this->selected;
    }
}
