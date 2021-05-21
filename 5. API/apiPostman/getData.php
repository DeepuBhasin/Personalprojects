<?php
// this line will help you to receive and output as json data
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');
header('Access-control-Allow-Method:GET');
header('Access-control-Allow-Headers:Content-Type,Access-Control-Allow-Origin,Access-control-Allow-Method,Authorization,X-Requested-With');
if($_SERVER['REQUEST_METHOD']=='GET')
{
	$data=json_decode(file_get_contents('php://input'),true);
	
	$name  = (isset($data['basics']['name']))?$data['basics']['name']:'Not Available';
	$label  = (isset($data['basics']['label']))?$data['basics']['label']:'Not Available';
	$email  = (isset($data['basics']['email']))?$data['basics']['email']:'Not Available';
	$phone  = (isset($data['basics']['phone']))?$data['basics']['phone']:'Not Available';
	$summary  = (isset($data['basics']['summary']))?$data['basics']['summary']:'Not Available';

	//address variables 
	$address  = (isset($data['basics']['location']['address']))?$data['basics']['location']['address']:'Not Available';
	$postalCode  = (isset($data['basics']['location']['postalCode']))?$data['basics']['location']['postalCode']:'Not Available';
	$city  = (isset($data['basics']['location']['city']))?$data['basics']['location']['city']:'Not Available';
	$countryCode  = (isset($data['basics']['location']['countryCode']))?$data['basics']['location']['countryCode']:'Not Available';
	$region  = (isset($data['basics']['location']['region']))?$data['basics']['location']['region']:'Not Available';


	//profile variables 
	$network  = (isset($data['basics']['profiles'][0]['network']))?$data['basics']['profiles'][0]['network']:'Not Available';
	$username  = (isset($data['basics']['profiles'][0]['username']))?$data['basics']['profiles'][0]['username']:'Not Available';
	$url  = (isset($data['basics']['profiles'][0]['url']))?$data['basics']['profiles'][0]['url']:'Not Available';


	echo json_encode(array('basic'=>array(
			'name'=>$name,
			'label'=>$label,
			'email'=>$email,
			'phone'=>$phone,
			'summary'=>$summary,
			'location'=>array(
				'address'=>$address,
				'postalCode'=>$postalCode,
				'city'=>$city,
				'countryCode'=>$countryCode,
				'region'=>$region
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

/*
1. value = 

{ 
 "basics": {
    "name" : "Deepinder",
    "label": "Programmer",
    "picture": "",
    "email": "john@gmail.com",
    "phone": "(912) 555-4321",
    "summary": "A summary of John Doe...",
    "location": {
      "address": "2712 Broadway St",
      "postalCode": "CA 94115",
      "city": "San Francisco",
      "countryCode": "US",
      "region": "California"
    },
    "profiles": [{
      "network": "Twitter",
      "username": "john",
      "url": "http://twitter.com/john"
    }]
  }}
*/

?>