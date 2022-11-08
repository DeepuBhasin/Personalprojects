<?php
class UpdateProfile extends Database
{

    private $error = [];

    public function validateData($data, $user_id)
    {
        if (empty($this->filterData($data['first_name']))) {
            array_push($this->error, 'Please Enter First Name');
        }
        if (empty($this->filterData($data['last_name']))) {
            array_push($this->error, 'Please Enter Last Name');
        }
        if (empty($this->filterData($data['mobile_number']))) {
            array_push($this->error, 'Please Last Mobile Number');
        }
        if (empty($this->filterData($data['date_of_birth']))) {
            array_push($this->error, 'Please Enter Data Of Birth');
        }
        if (empty($this->filterData($data['age']))) {
            array_push($this->error, 'Please Enter Age');
        }
        if (count($this->error)) {
            return $this->error;
        } else {
            return $this->updateProfileFuction($data, $user_id);
        }
    }
    public function updateProfileFuction($data, $user_id)
    {
        $first_name = $this->filterData($data['first_name']);
        $last_name = $this->filterData($data['last_name']);
        $mobile_number = $this->filterData($data['mobile_number']);
        $date_of_birth = $this->filterData($data['date_of_birth']);
        $age = $this->filterData($data['age']);
        $modified_dt  = date('Y-m-d : H:i:s');

        $response = $this->updateQuery("UPDATE users set first_name='$first_name', last_name='$last_name', mobile='$mobile_number',date_of_birth='$date_of_birth',age='$age',modified_dt='$modified_dt' WHERE id=$user_id");
        if($response == true) {
            return true;
        } else {
            array_push($this->error, 'Database Problem');
            return false;
        }

    }
    public function getUserData($user_id){
        return $this->selectQueryWithSingle("SELECT * FROM users WHERE id=$user_id");
    }

}

$updateProfile = new UpdateProfile();
