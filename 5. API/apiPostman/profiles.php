<?php
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');
header('Access-control-Allow-Method:GET');
header('Access-control-Allow-Headers:Content-Type,Access-Control-Allow-Origin,Access-control-Allow-Method,Authorization,X-Requested-With');
if($_SERVER['REQUEST_METHOD']=='GET')
{
	$data=json_decode(file_get_contents('php://input'),true);
	
	//profile variables 
	$network   = 	(isset($data['basics']['profiles'][0]['network']))?$data['basics']['profiles'][0]['network']:'Not Available';
	$username  = 	(isset($data['basics']['profiles'][0]['username']))?$data['basics']['profiles'][0]['username']:'Not Available';
	$url       =	(isset($data['basics']['profiles'][0]['url']))?$data['basics']['profiles'][0]['url']:'Not Available';



	echo json_encode(array(
		'profiles'=>array(
			'network'=>$network,
			'username'=>$username,
			'url'=>$url)
		)
	);
}
else
{
	die('Must Select GET Method');
}
/*
{ 
 "basics": {
    "profiles": [{
      "network": "Twitter",
      "username": "john",
      "url": "http://twitter.com/john"
    }]
  }}

*/


?>