<?php
class Login extends Database{
    
    private $error = [];
    
    public function validateData($data){
        if(empty($this->filterData($data['email_id']))){
            array_push($this->error,'Please Enter Email Id');
        }
        if(empty($this->filterData($data['password']))){
            array_push($this->error,'Please Enter Password');
        }
        if(count($this->error)){
            return $this->error;
        } else {
            return $this->checkLogin($data);    
        }
    }
    public function checkLogin($data){
        $email_id = $this->filterData($data['email_id']);
        $password = md5($this->filterData($data['password']));
        
        $query = "SELECT * FROM users WHERE  email='$email_id' and `password`='$password'";

        $respnse = $this->checkSelect($query);
        if($respnse == false){
            array_push($this->error,'Invalid Email/Password');
            return $this->error;
        } else {
           $responseData = $this->selectQueryWithSingle($query);
           session_start();
           $_SESSION['login_user'] = [
            'id' => $responseData['id'],
            'email' => $responseData['email'],
            'login_type' => $responseData['login_type'],
           ];
           return true;
        }
    }
}

$login = new Login();


?>