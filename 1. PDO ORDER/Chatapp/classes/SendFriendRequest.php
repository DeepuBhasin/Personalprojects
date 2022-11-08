<?php
class SendFrinedRequest extends Database{
    
    public function sendRequest($login_id, $friend_id){
        $query = "SELECT * from friend_list where login_id= $login_id and friends_id=$friend_id";
        $respnse = $this->checkQuery($query);
        if($respnse == false){
            return 'Request Already Sent';
        } else {
            $status = 0;
            $created_dt = date('Y-m-d H:i:s');
           $responseData = $this->insertQuery("INSERT INTO friend_list  values(null,$login_id,$friend_id,$status,'$created_dt');");
            if($responseData) {
                return 'Request Sent Successfully';
            } else {
                return 'Database Error';
            }
        }
    }
    public function deleteRequest($login_id, $friend_list_id){
        $check = $this->deleteQuery("DELETE FROM friend_list where login_id= $login_id and id=$friend_list_id");
        
        if($check) {
            return 'Request Deleted Successfully';
        } else {
            return 'Database Error';
        }
    }
    public function rejectRequest($login_id, $friend_list_id){
        $check = $this->deleteQuery("DELETE FROM friend_list where friends_id= $login_id and id=$friend_list_id");
        
        if($check) {
            return 'Request Deleted Successfully';
        } else {
            return 'Database Error';
        }
    }
    public function acceptRequest($login_id, $friend_list_id){
        $query = "SELECT * FROM friend_list where friends_id= $login_id and  id=$friend_list_id and  status=0 ";
        $response = $this->checkQuery($query);
        if($response === false) {
            $response  = $this->selectQueryWithSingle($query);
            $this->updateQuery("UPDATE friend_list set status=1 where id=$friend_list_id");
            $login_id = $response['friends_id'];
            $friend_id = $response['login_id'];
            $status = 1;
            $created_dt = date('Y-m-d H:i:s');
            $responseData = $this->insertQuery("INSERT INTO friend_list  values(null,$login_id,$friend_id,$status,'$created_dt');");
            if($responseData) {
                return 'Request Accepted Successfully';
            } else {
                return 'Database Error';
            }
        } else {
            return false;
        }
    }
    public function getAllRecivedRquest($login_id){
        $query = "SELECT u.*,fl.* from users as u INNER JOIN friend_list as fl ON fl.login_id=u.id where friends_id= $login_id and status=0 ";
        $response = $this->checkQuery($query);
        if($response === false) {
            return $this->selecQueryWithMulitpleRows($query);
        } else {
            return false;
        } 
    }
    public function getAllsentRquest($login_id){
        $query = "SELECT u.*,fl.* from users as u INNER JOIN friend_list as fl ON fl.friends_id=u.id where login_id= $login_id and status=0 ";
        $response = $this->checkQuery($query);
        if($response === false) {
            return $this->selecQueryWithMulitpleRows($query);
        } else {
            return false;
        } 
    }
    public function getFriendRquest($login_id, $friend_id){
        $query = "SELECT * from friend_list where login_id= $login_id and friends_id=$friend_id";
        $response = $this->checkQuery($query);
        if($response === false) {
            return $this->selectQueryWithSingle($query);
        } else {
            return false;
        } 
    }
    public function myfriendList($login_id){
        $query = "SELECT u.*, u.id as user_id,fl.* from users as u INNER JOIN friend_list as fl ON fl.friends_id=u.id where login_id= $login_id and status=1";
        $response = $this->checkQuery($query);
        if($response === false) {
            return $this->selecQueryWithMulitpleRows($query);
        } else {
            return false;
        } 
    }
}

$sendfrinedrequest = new SendFrinedRequest();


?>