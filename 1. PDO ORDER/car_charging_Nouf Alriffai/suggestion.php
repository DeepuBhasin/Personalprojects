<?php

require_once("Models/config.php");
require_once('Models/UserSearch.php');

if (isset($_POST["query"])) {
    $userSearchObj = new UserSearch($pdo);

    $data = array();

    $condition = preg_replace('/[^A-Za-z0-9\- ]/', '', $_POST["query"]);

    $result = $userSearchObj->getUserNAmeSuggestions($_POST['query']);

    $replace_string = '<b>' . $condition . '</b>';

    foreach ($result as $row) {

        if (isset($row['address'])) {
            $data[] = array(
                'fullname' => 'Name : ' . str_ireplace($condition, $replace_string, $row["fullname"]) . ', Address : ' . str_ireplace($condition, $replace_string, $row["address"]) . ', Price : ' . str_ireplace($condition, $replace_string, $row["price"])
            );
        } else {
            $data[] = array(
                'fullname' => 'Name : ' . str_ireplace($condition, $replace_string, $row["fullname"])
            );
        }
    }

    echo json_encode($data);
}
