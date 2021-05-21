<?php
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');
header('Access-control-Allow-Method:HEAD');
header('Access-control-Allow-Headers:Content-Type,Access-Control-Allow-Origin,Access-control-Allow-Method,Authorization,X-Requested-With');
if($_SERVER['REQUEST_METHOD']=='HEAD')
{
	/*This method return nothing*/
	$data=json_decode(file_get_contents('php://input'),true);
	
	$name  = (isset($data['basics']['name']))?$data['basics']['name']:'Not Available';
	$label  = (isset($data['basics']['label']))?$data['basics']['label']:'Not Available';
	$email  = (isset($data['basics']['email']))?$data['basics']['email']:'Not Available';
	$phone  = (isset($data['basics']['phone']))?$data['basics']['phone']:'Not Available';

	//address variables 
	$address  = (isset($data['basics']['location']['address']))?$data['basics']['location']['address']:'Not Available';
	$postalCode  = (isset($data['basics']['location']['postalCode']))?$data['basics']['location']['postalCode']:'Not Available';
	$city  = (isset($data['basics']['location']['city']))?$data['basics']['location']['city']:'Not Available';
	$countryCode  = (isset($data['basics']['location']['countryCode']))?$data['basics']['location']['countryCode']:'Not Available';
	$California  = (isset($data['basics']['location']['California']))?$data['basics']['location']['California']:'Not Available';


	//profile variables 
	$network  = (isset($data['basics']['profiles'][0]['network']))?$data['basics']['profiles'][0]['network']:'Not Available';
	$username  = (isset($data['basics']['profiles'][0]['username']))?$data['basics']['profiles'][0]['username']:'Not Available';
	$url  = (isset($data['basics']['profiles'][0]['url']))?$data['basics']['profiles'][0]['url']:'Not Available';


	echo json_encode(array('basic'=>array(
			'name'=>$name,
			'label'=>$label,
			'email'=>$email,
			'phone'=>$phone,
			'location'=>array(
				'address'=>$address,
				'postalCode'=>$postalCode,
				'city'=>$city,
				'countryCode'=>$countryCode,
				'California'=>$California
				)
			),
		'profiles'=>array(
			'network'=>$network,
			'username'=>$username,
			'url'=>$url)
		));
}
else
{
	die('Must Select GET Method');
}



?>