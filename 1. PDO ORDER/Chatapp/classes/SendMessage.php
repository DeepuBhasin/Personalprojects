<?php
class SendMessage extends Database{
    
    
    public function validateData($data,$id, $friend_id){
        if(empty($this->filterData($data['message']))){
            return 'Please Enter Message';
        }else{
            return $this->sendMessageToUser($data,$id, $friend_id);    
        }
    }
    public function sendMessageToUser($data, $id, $friend_id){
        $common_id = ($id + $friend_id)  * ($id * $friend_id);
        $message = $this->filterData($data['message']);
        $created_dt = date('Y-m-d : H:i:s');
        $respnse = $this->insertQuery("INSERT INTO message_table values(null,'$common_id',$id, $friend_id,'$message','$created_dt');");
        if($respnse == true){
            return 'Message Sent Successfully';
        } else {
           return 'Database Problem';
        }
    }
    public function getAllMessages($id, $friend_id){
        $common_id = ($id + $friend_id)  * ($id * $friend_id);
        $respnse = $this->selecQueryWithMulitpleRows("SELECT m.message,m.mid,m.created_dt as message_date,s.id as sender_id, r.id as receriver_id, concat(s.first_name,s.last_name) as sender_name, concat(r.first_name,r.last_name) as receiver_name, s.email as sender_email, r.email as receriver_email FROM users as s INNER JOIN message_table as m ON m.sender_id=s.id INNER JOIN users as r ON m.receriver_id = r.id WHERE common_id = '$common_id' ORDER BY m.created_dt ASC");
        if($respnse !== false){
            return $respnse['data'];
        } else {
           return [];
        }
    }
    public function deleteMessage($mid){
        $response = $this->deleteQuery("DELETE FROM message_table where mid=$mid");
        if($response){
            return 'Message Deleted Successfully';
        } else {
            return 'Database Problem';
        }
    }
    public function getSingleMessage($mid){
        $respnse = $this->selectQueryWithSingle ("SELECT * from  message_table where mid=$mid");
        if($respnse !== false){
            return $respnse;
        } else {
           return null;
        }
    }
    public function updateMessage($data,$mid){
        if(empty($this->filterData($data['message']))){
            return 'Please Enter Message';
        }else{
            $mesage = $this->filterData($data['message']);
            $response = $this->updateQuery("UPDATE message_table set message='$mesage' where mid=$mid");
            if($response) {
                return 'Message Updated Successfully';
            }else{
                return "Database Problem";
            }   
        }
    }
}

$sendmessage = new SendMessage();


?>