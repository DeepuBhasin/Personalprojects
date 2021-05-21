<?php
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');
header('Access-control-Allow-Method:DELETE');
header('Access-control-Allow-Headers:Content-Type,Access-Control-Allow-Origin,Access-control-Allow-Method,Authorization,X-Requested-With');

if($_SERVER['REQUEST_METHOD']=='DELETE'){
	$data=json_decode(file_get_contents('php://input'),true);
	
	if((isset($data['authentication']['username'])) && (isset($data['authentication']['password']))){
		if($data['authentication']['username']=='admin' &&$data['authentication']['password']=='admin'){

				//persoanl infromation 
					$name  = (isset($data['basics']['name']))?'':'John Doe';
					$label  = (isset($data['basics']['label']))?'':'Programmer';
					$email  = (isset($data['basics']['email']))?'':'john@gmail.com';
					$phone  = (isset($data['basics']['phone']))?'':'(912) 555-4321"';
					$summary  = (isset($data['basics']['summary']))?'':'A summary of John Doe...';

					//address variables 
					$address  = (isset($data['basics']['location']['address']))?'':'2712 Broadway St';
					$postalCode  = (isset($data['basics']['location']['postalCode']))?'':'"CA 94115';
					$city  = (isset($data['basics']['location']['city']))?'':'San Francisco';
					$countryCode  = (isset($data['basics']['location']['countryCode']))?'':'US';
					$region  = (isset($data['basics']['location']['region']))?'':'California';


					//profile variables 
					$network  = (isset($data['basics']['profiles'][0]['network']))?'':'Twitter';
					$username  = (isset($data['basics']['profiles'][0]['username']))?'':'john';
					$url  = (isset($data['basics']['profiles'][0]['url']))?'':'http://twitter.com/john';


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
		}else{
			die('Invalid Username or Password');
		}
	}else{
		die('AUTHENTICATION Failed');
	}
}else{
	die('Must Select DELETE Method');
}



/*
1. value = 

{ 
"authentication":{
  "username" : "admin",
  "password" : "admin"
},
"basics": {
    "name" : "",
    "label": "",
    "picture": "",
    "email": "",
    "phone": "",
    "summary": "",
    "location": {
      "address": "",
      "postalCode": "",
      "city": "",
      "countryCode": "",
      "region": ""
    },
    "profiles": [{
      "network": "",
      "username": "",
      "url": ""
    }]
  }}
*/






?>