<?php
class Database{
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $db_name = "test";
	protected $conn = false;


	public function __construct() {
		$this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);

		if(!$this->conn){
			die('Database Error : '.mysqli_connect_error());
		}
	}
	public function registration($first_name, $last_name, $email, $password, $confirmpassword) {
		
		$duplicate = mysqli_query($this->conn, "SELECT * FROM users WHERE email = '$email' ");
		if(mysqli_num_rows($duplicate) > 0) {
			return ['msg'=>'Username or Email has already Registserd','error' => true];
		}
		else {
			if($password === $confirmpassword) {

				$password = md5($password);

				$query = "INSERT INTO users  VALUES(null,'$first_name', '$last_name', '$email','$password')";
				
				$check = mysqli_query($this->conn, $query);
				
				if($check) {
					
					return ['msg'=>'Regsistration Successfully Done','error' => false];
				}else {
					
					return ['msg'=>'Databse Problem','error' => true];
				}
			}else {
				return ['msg'=>'Password does not match','error' => false];
				
			}
		}
	}
	
}

$db = new Database();


?>