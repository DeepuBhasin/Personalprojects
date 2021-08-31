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
		$array1 = $priceDocument[12];
	
		foreach($array1 as $key1=>$value1)
		{
			$array2 = $array1[$key1]['occupancies'];	
			
			foreach ($array2 as $key2=>$value2) 
			{
				$array_one_3 = $array2[$key2]['prices']['USD'];
				$array_two_3 = isset($array2[$key2]['promotions']['USD'])?$array2[$key2]['promotions']['USD']:0;
				
				$array_two_one_3 = $array_two_3['promo_price_per_person'];
				$array_two_two_3 = $array_two_3['promotions'][0];

				$data=[
					$priceDocument[0],
					$priceDocument[4],
					$priceDocument[12][$key1]['cabin_id'],
					$value2['occupancy_code'],
					$value2['price_per_person'],
					$value2['availability_status'],
					$value2['availability_description'],
					$value2['spaces_available'],
					isset($array_one_3['price_per_person'])?$array_one_3['price_per_person']:'0',
					isset($array_one_3['promo_price_per_person'])?$array_one_3['promo_price_per_person']:'0',
					isset($array_one_3['currency_code'])?$array_one_3['currency_code']:'0',
					isset($array_one_3['mandatory_transfer_price_per_person'])?$array_one_3['mandatory_transfer_price_per_person']:'0',
					isset($array_two_one_3)?$array_two_one_3:'0',
					isset($array_two_two_3['id'])?$array_two_two_3['id']:'0',
					isset($array_two_two_3['promo_code'])?$array_two_two_3['promo_code']:'0',
					isset($array_two_two_3['promo_name'])?$array_two_two_3['promo_name']:'0',
					isset($array_two_two_3['promo_start_date'])?$array_two_two_3['promo_start_date']:'0',
					isset($array_two_two_3['promo_end_date'])?$array_two_two_3['promo_end_date']:'0',	
					isset($array_two_two_3['promo_currency_code'])?$array_two_two_3['promo_currency_code']:'0',	
				];	
				 $sql.= "INSERT into  price_table values(null,'{$data[0]}','{$data[1]}','{$data[2]}','{$data[3]}','{$data[4]}','{$data[5]}','{$data[6]}','{$data[7]}','{$data[8]}','{$data[9]}','{$data[10]}','{$data[11]}','{$data[12]}','{$data[13]}','{$data[14]}','{$data[15]}','{$data[16]}','{$data[17]}');";
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