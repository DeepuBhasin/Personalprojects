<?php
header('Content-Type:application/json');				// it means here we are accepting json data and returning json data only 
header('Access-Control-Allow-Origin:*');
header('Access-control-Allow-Method:POST');
header('Access-control-Allow-Headers:Content-Type,Access-Control-Allow-Origin,Access-control-Allow-Method,Authorization,X-Requested-With');


$data=json_decode(file_get_contents('php://input'),true);	

$number1=$data['number1'];
$number2=$data['number2'];

function output($result=null){
	return json_encode($result);
}

if(!empty($number1) && !empty($number2)){
	$result = $number1 * $number2;
	echo output($result);
}else{
	echo output('Please Enter Values');
}








?>