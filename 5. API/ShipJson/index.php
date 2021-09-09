<?php 
	ini_set('max_execution_time', '0'); // for infinite time of execution 

	$document = file_get_contents('http://68.168.117.178/Prices/Hurt/newdata/Hurt-USD-Source.json');

	$document = json_decode($document,true);

	require('__db.php');

	$query="TRUNCATE hurtigruten;";
	mysqli_query($con,$query);
	

	$sql='';
	$c=0;

	$starting = microtime(true);
	
		foreach($document as $key=>$value)
		{
			$data = array(
					(!empty($value['MasterSailingId'])) ? $value['MasterSailingId'] : 0,
					(!empty($value['MasterPackageId'])) ? $value['MasterPackageId'] : 0,
					(!empty($value['Pax'])) ? $value['Pax'] : 0,
					(!empty($value['Category'])) ? $value['Category'] : 0,
					(!empty($value['SuperCategory'])) ? $value['SuperCategory'] : 0,
					(!empty($value['AvailableCabins'])) ? $value['AvailableCabins'] : 0,
					(!empty($value['Rate_Sgl'])) ? $value['Rate_Sgl'] : 0,
					(!empty($value['Rate_Dbl'])) ? $value['Rate_Dbl'] : 0,
					(!empty($value['RateCode'])) ? $value['RateCode'] : 0,
			);
			$sql= "INSERT into  hurtigruten values(null,'{$data[0]}','{$data[1]}','{$data[2]}','{$data[3]}','{$data[4]}','{$data[5]}','{$data[6]}','{$data[7]}','{$data[8]}');";	
			$check=mysqli_query($con,$sql);
			if($check){
				$success=true;
				$c++;
			}
			if(!$check){
				$success = false;
			}	
		}

	if($success){
       	echo "SUCCESS: $c Record Added Successfully <br/> Program Take Time for Completion : ".((microtime(true)-$starting)/60).' minutes'; 
       }else{
       	echo mysqli_error($con);
       }
	

?>