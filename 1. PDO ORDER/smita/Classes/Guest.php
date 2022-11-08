<?php 

class Guest extends Database {
	
	public function createGuest($user_id,$full_name, $email ) {
		
		$duplicate = mysqli_query($this->conn, "SELECT * FROM guest_list WHERE email = '$email' and user_id = $user_id");
		if(mysqli_num_rows($duplicate) > 0) {
			
			return ['msg'=>' Guest already Added','error' => true];
		}
		else {
				$result = "INSERT INTO guest_list VALUES (null,'$full_name', '$email',$user_id)"; 
	
				$check = mysqli_query($this->conn, $result);
				if($check) {
					
					return ['msg'=>'Guest Added Successfully','error' => false];
				}else {
					
					return ['msg'=>'Databse Problem','error' => true];
				}
			
			}
	}

	 public function getAllGuest(){
		$query = mysqli_query($this->conn, "SELECT
		u.*,g.*
		FROM
		users as u 
		INNER JOIN guest_list as g ON g.user_id=u.id");

		while($row = mysqli_fetch_assoc($query)){
			$data[] = $row; 
		}
		return $data;
		
	 }	
	
}	
$guest = new Guest();
?>