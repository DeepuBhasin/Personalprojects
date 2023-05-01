<?php 
class Map
{
    public $db;

    function __construct($db)
    {
        $this->db = $db;
    }
    public function getAllNearbyChargerLocation($lat, $long)
    {
        $sql = "SELECT cp.*, u.*, 111.045 * DEGREES(ACOS(COS(RADIANS($lat))
        * COS(RADIANS(lat))
        * COS(RADIANS(lng) - RADIANS($long))
        + SIN(RADIANS($lat))
        * SIN(RADIANS(lat))))
        AS distance_in_km
       FROM charge_point as cp
       LEFT JOIN users as u ON u.id = cp.owner_id
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
