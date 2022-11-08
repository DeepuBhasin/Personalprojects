<?php 

class Admin extends Database {

	public function signin($username, $password) {
		
		$password = md5($password);	

		$result = mysqli_query($this->conn, "SELECT * FROM admin WHERE `username` = '$username' and `password` = '$password' ");
		
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
		$result = mysqli_query($this->conn, "SELECT username,email FROM admin WHERE id=$id ");
		
		$row = mysqli_fetch_assoc($result);
		
		return $row;
	}
}

$admin = new Admin();
?>