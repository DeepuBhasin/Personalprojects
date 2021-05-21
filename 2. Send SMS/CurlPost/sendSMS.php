<?php
	
	$apiKey = '3f33f026'; //Nexmo API KEY
	$apiSecret = 't2n59HTHV4SAZU5d'; //Nexmo API SECRET
	$sendFrom = '12044808931';

	if((!empty($_POST['phoneNumbers'])) && (!empty($_POST['messageBody']))){
		$messageBody = $_POST['messageBody'];
		$phoneNumbers = $_POST['phoneNumbers'];
		$phoneNumbers = explode(',', $phoneNumbers);

		$count = count($phoneNumbers);
		for ($i=0; $i < $count; $i++) { 
			$number = trim($phoneNumbers[$i]);
			
			$url = 'https://rest.nexmo.com/sms/json?';
			$url .= 'api_key='.$apiKey;
			$url .= '&api_secret='.$apiSecret;
			$url .= '&to='.$number;
			$url .= '&from='.$sendFrom;
			$url .= '&text='.urlencode($messageBody);

			$ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	        $response = curl_exec($ch);
	        curl_close($ch);
	        usleep(500000);
		}
	}
?>