<?php

class User
{
    public $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    // for username availblty
    public function getData()
    {
        $sql = "SELECT  * FROM users INNER JOIN charge_point  ON users.id = charge_point.owner_id where user_type='Home Owner'";
        $result = $this->db->query($sql);
        $row = $result->fetchall(PDO::FETCH_ASSOC);
        if (!empty($row) && is_array($row)) {
            return $row;
        } else {
            return [];
        }
    }

    public function getSearchData($query)
    {
        $sql = "SELECT  * FROM charge_point where `loc` LIKE '%$query%' OR  `lat` LIKE '%$query%' OR `lng` LIKE '%$query%' OR  `price` LIKE '%$query%'  ";
        $result = $this->db->query($sql);
        $row = $result->fetchall(PDO::FETCH_ASSOC);
        if (!empty($row) && is_array($row)) {
            return $row;
        } else {
            return [];
        }
    }

    public function getSingleData($id)
    {
        $sql = "SELECT  * FROM charge_point where id='$id'";
        $result = $this->db->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        if(!empty($row) && is_array($row)) {
            return $row;
        }else {
            return [];
        }
    }

    // Function for registration
    public function registration($display_name, $user_name, $password, $user_type)
    {
        $sql = "INSERT INTO users (display_name, user_name, password, user_type)
            VALUES ('$display_name','$user_name','$password','$user_type')";
            if($this->db->query($sql)){
                $last_id = $this->db->lastInsertId();
            }
            return $last_id;
    }

    public function addbooking($start_date, $end_date, $display_name, $user_id)
    {
        $sql = "INSERT into booking(start_date,end_date,display_name,user_id) values('$start_date','$end_date','$display_name','$user_id')";
        if ($this->db->query($sql)) {
            $last_id = $this->db->lastInsertId();
        }
        return $last_id;
    }
    // Function for signin
    public function signin($uname, $pasword)
    {
        $sql = "SELECT id, display_name, user_type FROM users WHERE user_name='$uname' AND password='$pasword'";
        $result = $this->db->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        if(!empty($row) && is_array($row)) {
            return $row;
        }else {
            return [];
        }
    }
}
