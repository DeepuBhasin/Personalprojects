<?php

class UserData {

    //private fields
    protected $id, $fullname, $username, $usertype, $photoName;

    // constructor passing the database row
    public function __construct($dbRow) {
        $this->id = $dbRow['user_id'];
        $this->fullname = $dbRow['display_name'];
        $this->username = $dbRow['username'];
        $this->usertype = $dbRow['usertype'];
    }

    // accessor for user id
    public function getUserID() {
        return $this->id;
    }

    // accessor for fullname
    public function getFullName() {
       return $this->fullname;
    }

    // accessor for username
    public function getUsername() {
        return $this->username;
    }

    // accessor for usertype
    public function getUserType() {
       return $this->usertype;
    }

}


