<?php 

class User extends Database {
	
	public function signin($email, $password) {

		$password = md5($password);	
		$result = mysqli_query($this->conn, "SELECT * FROM users WHERE `email` = '$email' and `password` = '$password' ");
		
		$row = mysqli_fetch_assoc($result);

		if(mysqli_num_rows($result) > 0) {

			$this->userdata = $row;
			
			return ['msg'=>'Login Successfully Done','error' => false, 'data' => $row];

		} else {
			
			return ['msg'=>'Email/Password Invalid','error' => true, 'data' => null];
		}
	}

	public function getUserData($id)
	{
		
		$result = mysqli_query($this->conn, "SELECT first_name,last_name FROM users WHERE id=$id ");
		
		$row = mysqli_fetch_assoc($result);
		
		return $row;
	}
}

$user = new User();
?>