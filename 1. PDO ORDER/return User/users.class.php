<?php

include "dbc.class.php";

class Schedules extends Dbc {

	public function get_users($send_date){

		$sql = "SELECT s.*,u.user FROM schedules as s INNER JOIN users as u ON u.id = s.user_id and created_at='$send_date'";
				
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute();


		$test = $this->connect()->prepare($sql);
		$test->execute();

		$c=0;
		$user=[];
		while ($row = $stmt->fetch())
		{
			if(!in_array($row['user_id'], $user))
			{
				$user[$c]=$row['user_id'];
				++$c;
			}	
		}
		while($row=$test->fetch())
		{	
			$schedules[]=array( 
                'schedules_id' => $row['id'],
                'user' => $row['user'],
                'user_id' => $row['user_id'],
                'status' => $row['status'],
                'content' => $row['content'],
                'return_date' => $row['return_date'],
                'remarks' => $row['remarks'],
                'created_at' => $row['created_at']
                );		
		}
		
		for($z=0;$z<count($user);$z++)
		{

			for ($y=0; $y<count($schedules) ; $y++) 
			{ 
				if($user[$z]==$schedules[$y]['user_id'])
				{
					
					$results[$z]['user']=$schedules[$y]['user'];
					$results[$z]['id']=$schedules[$y]['user_id'];
					$results[$z]['schedules'][$y]['id']=$schedules[$y]['schedules_id'];
					$results[$z]['schedules'][$y]['status']=$schedules[$y]['status'];
					$results[$z]['schedules'][$y]['content']=$schedules[$y]['content'];
					$results[$z]['schedules'][$y]['return_date']=$schedules[$y]['return_date'];
					$results[$z]['schedules'][$y]['created_at']=$schedules[$y]['created_at'];

				}
			}
		}
		// print_r($results);
		if(isset($results))
		{
			return json_encode($results);
		}
		else
		{
			return json_encode("No Record found");
		}	
		

	}	

	public function insert_user($user){
		$sql = "INSERT INTO users (user) VALUES (?)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$user]);				
	}

	public function edit_user($user, $id){		
		$sql = "UPDATE `users` SET `user` = ? WHERE id = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$user, $id]);		
	}
	
	public function delete_user($id){		
		$sql = "DELETE FROM `users` WHERE id = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id]);		
	}
	public function insert_schedule($user_id, $status, $content, $date,$time, $remarks, $created_at)
	{

		$return_date=$date.' '.$time;

		$sql="SELECT * FROM schedules where user_id=? and status=?";

		$stmt = $this->connect()->prepare($sql);

		$stmt->execute([$user_id, $status]);

		if($stmt->rowCount()==0)
		{
			$sql = "INSERT INTO schedules(user_id, status, content, return_date, remarks, created_at) VALUES(?,?,?,?,?,?) ";
			$stmt = $this->connect()->prepare($sql);
			$ok=$stmt->execute([$user_id, $status, $content, $return_date, $remarks, $created_at]);

			
			if($ok)
			{
				echo  "Data Inserted Successfully";
			}
			else
			{
				echo "Date Not Inserted";
			}
		}
		else
		{
			$sql = "UPDATE schedules set content=?, return_date=?, remarks=?, created_at=? WHERE user_id=? and status=?";
			$stmt = $this->connect()->prepare($sql);
			$ok=$stmt->execute([$content, $return_date, $remarks, $created_at,$user_id, $status]);

			
			if($ok)
			{
				echo  "Data Updated Successfully";
			}
			else
			{
				echo "Date Not Updated";
			}
		}
	
	}
	
}
	$test = new Schedules();
	// echo "<pre>";
	// print_r($test->get_users('2020-04-15'));

	$test->insert_schedule(1,"Deepinder","web Developer","2020-04-06", "14:12:15","No One","2020-12-12");