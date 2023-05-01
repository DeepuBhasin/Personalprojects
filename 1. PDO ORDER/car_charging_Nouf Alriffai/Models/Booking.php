<?php 
class Booking 
{
    public $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    public function addbooking($start_date, $end_date, $user_id, $charger_id)
    {
        $sql = "INSERT into booking(start_date,end_date,user_id, charger_id) values('$start_date','$end_date','$user_id','$charger_id')";
        if ($this->db->query($sql)) {
            $last_id = $this->db->lastInsertId();
        }
        return $last_id;
    }

    public function myBooking($user_id) {
        $sql = "SELECT  * FROM booking as b LEFT JOIN charge_point as cp ON  cp.id = b.charger_id LEFT JOIN users as u ON  cp.owner_id = u.id where b.user_id='$user_id'";
        $result = $this->db->query($sql);
        $row = $result->fetchall(PDO::FETCH_ASSOC);
        if(!empty($row) && is_array($row)) {
            return $row;
        }else {
            return [];
        }
    }

    public function myChargerBooking($charger_id) {
        $sql = "SELECT  * FROM booking as b LEFT JOIN charge_point as cp ON  cp.id = b.charger_id LEFT JOIN users as u ON  b.user_id = u.id where b.charger_id='$charger_id'";
        $result = $this->db->query($sql);
        $row = $result->fetchall(PDO::FETCH_ASSOC);
        if(!empty($row) && is_array($row)) {
            return $row;
        }else {
            return [];
        }
    }
}
?>