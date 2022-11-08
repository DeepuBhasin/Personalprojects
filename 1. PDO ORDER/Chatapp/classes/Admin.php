<?php
class Admin extends Database{
    public function deleteProfile($id){
       $this->deleteQuery("DELETE FROM users where id=$id");
       $this->deleteQuery("DELETE FROM friend_list where login_id=$id");
       $this->deleteQuery("DELETE FROM friend_list where friends_id=$id");
       $this->deleteQuery("DELETE FROM message_table where sender_id=$id");
       $this->deleteQuery("DELETE FROM message_table where receriver_id=$id");

       return 'User Profile and All Data realted to User Deleted successfully';
    }
    public function getAllUsers($id){
        $respons = $this->selecQueryWithMulitpleRows("SELECT * FROM users where id<>$id");
        if($respons){
            return $respons;
        } else {
            return [];
        }
    }
}

$admin = new Admin();
?>