<?php
Class Database{
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "chatapp";

    protected $conn = false;

    public function __construct()
    {
        $this->conn = mysqli_connect(
            $this->hostname,
            $this->username,
            $this->password,
            $this->dbname
        );
        
        if(!$this->conn){
            die(mysqli_connect_error());
        }  
    }

    public function checkQuery($sqlQuery){
        $check = mysqli_query($this->conn, $sqlQuery);
        if(mysqli_num_rows($check) > 0){
            return false;
        } else {
            return true;
        }
    }

    public function checkSelect($selectQuery){
        $check = mysqli_query($this->conn, $selectQuery);
        if(mysqli_num_rows($check) == 1){
            return true;
        } else {
            return false;
        }
    }

    public function insertQuery($insertQuery){
        $check = mysqli_query($this->conn, $insertQuery);
        if($check){
            return true;
        } else {
            return false;
        }
    }

    public function updateQuery($updateQuery){
        $check = mysqli_query($this->conn, $updateQuery);
        if($check){
            return true;
        } else {
            return false;
        }
    }
    
    public function selectQueryWithSingle($selectQuery){
        $row = mysqli_query($this->conn,$selectQuery);
        return mysqli_fetch_array($row,MYSQLI_ASSOC);
    }

    public function selecQueryWithMulitpleRows($selectQuery){
        $row = mysqli_query($this->conn,$selectQuery);  
        if(mysqli_num_rows($row) > 0){
            $data = [];
            while($a = mysqli_fetch_assoc($row)){
                $data [] = $a;
            }
            return ['status' => true , 'data' => $data];
        } else {
            return false ;
        }
    }
    public function deleteQuery($deleteQuery){
        $check = mysqli_query($this->conn,$deleteQuery);
        if($check){
            return true;
        } else {
            return false;
        }  
    }

    public function filterData($data){
        $data = trim($data);
        $data = htmlentities($data);
        $data = mysqli_real_escape_string($this->conn,$data);
        return $data;
    }

    // public function __destruct()
    // {
    //     mysqli_close($this->conn);
    // }

}
?>