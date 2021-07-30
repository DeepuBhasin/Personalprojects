<?php 
	ini_set('max_execution_time', '0'); // for infinite time of execution 

	$document = file_get_contents('https://www.quarkexpeditions.com/api/public/1/departure');

	$document = json_decode($document,true);

	$document = array_values($document);


	require('__db.php');

	$query="TRUNCATE main_table;";
	mysqli_query($con,$query);
	$query="TRUNCATE price_table;";
	mysqli_query($con,$query);

	$sql='';
	$c=0;

	$starting = microtime(true);
	foreach($document as $key=>$value)
	{
		$id = $value['id'];

		$priceDocument = file_get_contents('https://www.quarkexpeditions.com/api/public/1/departure/'.$id);

		$priceDocument = json_decode($priceDocument,true);

		$priceDocument = array_values($priceDocument);
	
		foreach($priceDocument[12] as $key1=>$value1)
		{
			foreach ($priceDocument[12][$key1]['occupancies'] as $key2=>$value2) 
			{
				$data[]=[
					$priceDocument[0],
					$priceDocument[4],
					$priceDocument[12][$key1]['cabin_id'],
					$value2['occupancy_code'],
					$value2['price_per_person'],
					$value2['availability_status'],
					$value2['availability_description'],
					$value2['spaces_available']

				];	
				 $sql.= "INSERT into  price_table values(null,'{$priceDocument[0]}','{$priceDocument[4]}','{$priceDocument[12][$key1]['cabin_id']}','{$value2['occupancy_code']}','{$value2['price_per_person']}','{$value2['availability_status']}','{$value2['availability_description']}','{$value2['spaces_available']}');";
			}
		}


		$modified = $value['modified'];
		$departure_name = $value['departure_name'];
		$url = $value['url'];
		$departure_id = $value['departure_id'];
		$expedition_id = $value['expedition_id'];
		$ship_id = $value['ship_id'];
		$ship_name = $value['ship_name'];
		$start_date = $value['start_date'];
		$end_date = $value['end_date'];
		$duration_days = $value['duration_days'];
		$itinerary_id = $value['itinerary_id'];

		$sql.= "INSERT into main_table values('$id','$modified','$departure_name','$url','$departure_id','$expedition_id','$ship_id','$ship_name','$start_date','$end_date','$duration_days','$itinerary_id');";
		$c++;
	}
	if (mysqli_multi_query($con, $sql))
	 {
       echo "SUCCESS: $c Record Added Successfully";
	   	} 
	   	else {
	       echo 'ERROR: ' . mysqli_error($con);
	   }
	
	echo microtime(true)-$starting;
	

?>