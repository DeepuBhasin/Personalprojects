<?php

class BookingData
{

    protected $id, $start_date, $end_date, $user_id, $date_last_updated, $charger_id, $display_name, $loc, $lat, $lng, $price;

    public function __construct($dbRow)
    {
        $this->id = $dbRow['id'];
        $this->start_date = $dbRow['start_date'];
        $this->end_date = $dbRow['end_date'];
        $this->user_id = $dbRow['user_id'];
        $this->date_last_updated = $dbRow['date_last_updated'];
        $this->charger_id = $dbRow['charger_id'];
        $this->display_name = $dbRow['display_name'];
        
        $this->loc = $dbRow['loc'];
        $this->lat = $dbRow['lat'];
        $this->lng = $dbRow['lng'];
        $this->price = $dbRow['price'];
    }

    public function getBookingID()
    {
        return $this->id;
    }

    public function getStartDate()
    {
        return $this->start_date;
    }

    public function getEndDate()
    {
        return $this->end_date;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getChargerId()
    {
        return $this->charger_id;
    }

    public function getOwnerName()
    {
        return $this->display_name;
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
}
