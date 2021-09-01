<?php
ini_set('max_execution_time', '0'); // for infinite time of execution 
error_reporting(0);

$xml =simplexml_load_file('http://xmltariff.talend.ponant.com:8087/CDP_XML_TARIFF?txtAgtID=39075&txtPwd=39075240521');

// Convert into json
$con = json_encode($xml);
  
// Convert into associative array
$xml = json_decode($con, true);
 
 echo "<pre>";

require('__db.php');

$query="TRUNCATE TABLE xml_table;";
mysqli_query($con,$query);


$sql='';
$c=0;

$starting = microtime(true);

$firstArray = $xml['ships'];

	foreach($firstArray as $key1=>$value1)
	{
		foreach ($value1 as $key2=>$value2)
		{
			foreach ($value1['cruises'] as $key3=>$value3) 
			{
				foreach ($value3['categories'] as $key4=>$value4) 
				{
					foreach ($value4['prices'] as $key5=>$value5)
					{


						if($value5['currency']=='USD')
						{
							
							$data=array(
								addslashes($value4['categ_description']),
								addslashes($value4['capacity_categ']),
								addslashes($value5['ship_name']),
								addslashes($value5['cruise_id']),
								addslashes($value5['categ_type']),
								$value5['currency'],
								$value5['single_price'],
								$value5['double_price'],
								$value5['third_price'],
								(!empty($value5['child_price'])) ? $value5['child_price'] : 0,
								(!empty($value5['baby_price'])) ? $value5['baby_price'] : 0,
								(!empty($value5['tax_amount'])) ? $value5['tax_amount'] : 0,
							);	

							
							$sql= "INSERT into xml_table values(null,'{$data[0]}','{$data[1]}','{$data[2]}','{$data[3]}','{$data[4]}','{$data[5]}','{$data[6]}','{$data[7]}','{$data[8]}','{$data[9]}','{$data[10]}','{$data[11]}');";
							$check=mysqli_query($con,$sql);
							if($check){
								$success=true;
								$c++;
							}
							if(!$check){
								$success = false;
							}
							
						}
					}
						
				}
			}
		}
	}
	
	error_reporting(E_ALL);
	if($success){
       	echo "SUCCESS: $c Record Added Successfully <br/> Program Take Time for Completion : ".((microtime(true)-$starting)/60).' minutes'; 
       }else{
       	echo mysqli_error($con);
       }
	


?>	