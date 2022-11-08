<?php
class SignUp extends Database{
    
    private $error = [];
    
    public function validateData($data){
        if(empty($this->filterData($data['first_name']))){
            array_push($this->error,'Please Enter First Name');
        }
        if(empty($this->filterData($data['last_name']))){
            array_push($this->error,'Please Enter Last Name');
        }
        if(empty($this->filterData($data['mobile_number']))){
            array_push($this->error,'Please Last Mobile Number');
        }
        if(empty($this->filterData($data['email_id']))){
            array_push($this->error,'Please Enter Email Id');
        }
        if(empty($this->filterData($data['password']))){
            array_push($this->error,'Please Enter Password');
        }
        if($data['password'] !== $data['confirm']){
            array_push($this->error,'Password and Confirm Password do not matched');
        }
        if(empty($this->filterData($data['confirm']))){
            array_push($this->error,'Please Enter Confirm-Password');
        }
        if(empty($this->filterData($data['date_of_birth']))){
            array_push($this->error,'Please Enter Data Of Birth');
        }
        if(empty($this->filterData($data['age']))){
            array_push($this->error,'Please Enter Age');
        }

        if(count($this->error)){
            return $this->error;
        } else {
            return $this->insertSignUpData($data);    
        }
    }
    public function insertSignUpData($data){
        $first_name = $this->filterData($data['first_name']);
        $last_name = $this->filterData($data['last_name']);
        $email_id = $this->filterData($data['email_id']);
        $mobile_number = $this->filterData($data['mobile_number']);
        $password = md5($this->filterData($data['password']));
        $date_of_birth = $this->filterData($data['date_of_birth']);
        $age = $this->filterData($data['age']);
        $login_type = 'u';
        $created_dt  = date('Y-m-d : H:i:s');

        $respnse = $this->checkQuery("SELECT * FROM users WHERE  email='$email_id' and `password`='$password'");
        if($respnse == false){
            array_push($this->error,'Email Id already Registered');
            return $this->error;
        } else {
           $response = $this->insertQuery("INSERT INTO users values(null, '$first_name','$last_name','$email_id','$mobile_number','$password','$date_of_birth','$age','$login_type','$created_dt',null)");
           
           if($response == true) {
                return true;
            } else {
                array_push($this->error, 'Database Problem');
                return false;
            }
           
        }
    }
}

$signup = new SignUp();


?>