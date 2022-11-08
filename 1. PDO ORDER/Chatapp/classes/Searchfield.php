<?php
class SerachFriend extends Database
{

    private $error = [];

    public function validateData($data, $user_id)
    {
        if(empty($this->filterData($data['search_field']))){
            array_push($this->error,'Please Enter Name/Email id in Search field');
        }
        
        if (count($this->error)) {
            return $this->error;
        } else {
            return $this->getFriendList($data, $user_id);
        }
    }
    public function getFriendList($data, $user_id)
    {
        $search_field = $this->filterData($data['search_field']);
        $respnse = $this->selecQueryWithMulitpleRows("SELECT *  FROM users as u  WHERE id<>$user_id and first_name not Like '%admin%' and (first_name LIKE '%$search_field%' or email LIKE '%$search_field%')");
        if($respnse == false){
            array_push($this->error,"No Person Exist with '$search_field'");
            return $this->error;
        } else {
            return $respnse;
        }
    }
}

$searchfriend = new SerachFriend();
