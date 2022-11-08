<?php
class ChangePassword extends Database
{

    private $error = [];

    public function validateData($data, $user_id)
    {
        if(empty($this->filterData($data['old_password']))){
            array_push($this->error,'Please Enter Old Password');
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
        if (count($this->error)) {
            return $this->error;
        } else {
            return $this->updateProfileFuction($data, $user_id);
        }
    }
    public function updateProfileFuction($data, $user_id)
    {
        $old_password = md5($this->filterData($data['old_password']));
        $password = md5($this->filterData($data['password']));
        
        $respnse = $this->checkSelect("SELECT * FROM users WHERE id='$user_id' and `password`='$old_password'");
        
        if($respnse == false){
            array_push($this->error,'Old Passord do not matched');
            return $this->error;
        } else {
            $response = $this->updateQuery("UPDATE users set password='$password' WHERE id=$user_id");
            if($response == true) {
                return true;
            } else {
                array_push($this->error, 'Database Problem');
                return false;
            }
        }

        

    }
}

$changepassword = new ChangePassword();
