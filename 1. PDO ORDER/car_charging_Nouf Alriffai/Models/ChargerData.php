<?php

class ChargerData
{

    protected $id, $owner_id, $loc, $lat, $lng, $price, $date_last_updated, $display_name;

    public function __construct($dbRow)
    {
        $this->id = $dbRow['id'] ?? '';
        $this->owner_id = $dbRow['owner_id']  ?? 0;
        $this->loc = $dbRow['loc'] ?? '';
        $this->lat = $dbRow['lat'] ?? '';
        $this->lng = $dbRow['lng'] ?? '';
        $this->price = $dbRow['price'] ?? '';
        $this->date_last_updated = $dbRow['date_last_updated'] ?? '';
        $this->display_name = $dbRow['display_name'] ?? '';
    }

    public function getChargerID()
    {
        return $this->id;
    }

    public function getOwnerID()
    {
        return $this->owner_id;
    }

    public function getLocation()
    {
        return $this->loc;
    }

    public function getLat()
    {
        return $this->lat;
    }

    public function getLog()
    {
        return $this->lng;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getOwnerName()
    {
        return $this->display_name;
    }
    
}
