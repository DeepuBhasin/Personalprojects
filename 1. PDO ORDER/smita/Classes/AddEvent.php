<?php 
class AddEvent extends Database {
	
public function createEvent($user_id,$date, $event) {
		
	$duplicate = mysqli_query($this->conn, "SELECT * FROM occassion WHERE date(event_date) = date('$date')");
	if(mysqli_num_rows($duplicate) > 0) {
		
		return ['msg'=>' Date has already taken','error' => true];
	}
	else {
			$result = "INSERT INTO occassion VALUES (null,'$event', '$date', NOW(),$user_id)"; 

			$check = mysqli_query($this->conn, $result);
			if($check) {
				
				return ['msg'=>'Event Added Successfully','error' => false];
			}else {
				
				return ['msg'=>'Databse Problem','error' => true];
			}
		
		}
	}
	
	public function getAllEvent(){
		$query = mysqli_query($this->conn, "SELECT
		u.*,o.*
		FROM
		users as u 
		INNER JOIN occassion as o ON o.user_id=u.id");

		while($row = mysqli_fetch_assoc($query)){
			$data[] = $row; 
		}
		return $data;
		
	 }
}	

$addEvent = new AddEvent();


?>