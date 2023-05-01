<?php
class Charger
{
    public $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    public function totalChargers()
    {
        $sql = "SELECT * FROM charge_point ";
        $result = $this->db->query($sql);
        $row = $result->fetchall(PDO::FETCH_ASSOC);
        if (!empty($row) && is_array($row)) {
            return $row;
        } else {
            return [];
        }
    }

    public function getChargerData($start_from, $limit)
    {
        $sql = "SELECT cp.*, u.display_name FROM charge_point as cp LEFT JOIN users as u ON u.id = cp.owner_id   ORDER BY `cp`.`id` DESC LIMIT $start_from, $limit";
        $result = $this->db->query($sql);
        $row = $result->fetchall(PDO::FETCH_ASSOC);
        if (!empty($row) && is_array($row)) {
            return $row;
        } else {
            return [];
        }
    }


    public function getSearchData($query, $start_from, $limit)
    {
        $sql = "SELECT cp.*, u.display_name FROM charge_point  as cp LEFT JOIN users as u  ON u.id = cp.owner_id WHERE u.display_name like '%$query%' OR  `loc` LIKE '%$query%' OR  `lat` LIKE '%$query%' OR `lng` LIKE '%$query%' OR  `price` LIKE '%$query%' ORDER BY `cp`.`id` DESC LIMIT $start_from, $limit";
        $result = $this->db->query($sql);
        $row = $result->fetchall(PDO::FETCH_ASSOC);
        if (!empty($row) && is_array($row)) {
            return $row;
        } else {
            return [];
        }
    }

    public function getAllSearchData($query)
    {
        $sql = "SELECT cp.*, u.display_name FROM charge_point  as cp LEFT JOIN users as u  ON u.id = cp.owner_id WHERE `loc` LIKE '%$query%' OR  `lat` LIKE '%$query%' OR `lng` LIKE '%$query%' OR  `price` LIKE '%$query%' ORDER BY `cp`.`id` DESC";
        $result = $this->db->query($sql);
        $row = $result->fetchall(PDO::FETCH_ASSOC);
        if (!empty($row) && is_array($row)) {
            return $row;
        } else {
            return [];
        }
    }

    public function getSingleChargerData($id)
    {
        $sql = "SELECT  * FROM charge_point where id='$id'";
        $result = $this->db->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        if (!empty($row) && is_array($row)) {
            return $row;
        } else {
            return [];
        }
    }

    public function addCharger($loc, $lat, $lng, $price, $owner_id)
    {
        $sql = "INSERT into charge_point(loc,lat,lng,price,owner_id) values('$loc','$lat','$lng','$price','$owner_id')";
        if ($this->db->query($sql)) {
            $last_id = $this->db->lastInsertId();
        }
        return $last_id;
    }

    public function update($loc, $lat, $lng, $price, $charger_id)
    {
        $sql = "UPDATE charge_point SET loc='$loc',lat='$lat',lng='$lng',price='$price' WHERE id='$charger_id'";
        $roweffected = $this->db->exec($sql);
        if (!empty($roweffected)) {
            return $roweffected;
        } else {
            return 0;
        }
    }

    public function getMyChargers($user_id, $start_from, $limit)
    {
        $sql = "SELECT cp.*, u.display_name FROM charge_point as cp LEFT JOIN users as u ON u.id = cp.owner_id WHERE cp.owner_id = $user_id  ORDER BY `cp`.`id` DESC";
        if ($limit > 0) {
            $sql .= " LIMIT $start_from, $limit";
        }
        $result = $this->db->query($sql);
        $row = $result->fetchall(PDO::FETCH_ASSOC);
        if (!empty($row) && is_array($row)) {
            return $row;
        } else {
            return [];
        }
    }

    public function getAllChargerData($lat, $long)
    {
        $sql = "SELECT id, loc, lat, lng, 111.045 * DEGREES(ACOS(COS(RADIANS($lat))
        * COS(RADIANS(lat))
        * COS(RADIANS(lng) - RADIANS($long))
        + SIN(RADIANS($lat))
        * SIN(RADIANS(lat))))
        AS distance_in_km
       FROM charge_point
       ORDER BY distance_in_km ASC
       LIMIT 0,10;";
        $result = $this->db->query($sql);
        $row = $result->fetchall(PDO::FETCH_ASSOC);
        if (!empty($row) && is_array($row)) {
            return $row;
        } else {
            return [];
        }
    }
}
