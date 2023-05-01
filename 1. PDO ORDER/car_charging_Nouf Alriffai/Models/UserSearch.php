<?php
class UserSearch
{
    public $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    public function getUserNAmeSuggestions($query)
    {

        $sql = "SELECT ua.display_name as fullname, cs.loc as address, cs.price FROM `users` as ua LEFT JOIN charge_point as cs ON cs.owner_id = ua.id  WHERE user_type = 'Home Owner'  and  ua.display_name LIKE '%$query%'  OR cs.loc LIKE '%$query%' OR cs.price like '%$query%' limit 10";
        $result = $this->db->query($sql);
        $row = $result->fetchall(PDO::FETCH_ASSOC);
        if (!empty($row) && is_array($row)) {
            return $row;
        } else {
            return [];
        }
    }
}
