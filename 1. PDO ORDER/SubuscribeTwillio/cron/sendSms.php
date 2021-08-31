<?php
$sid = 'ACa97ec5b67df9d5218763e446cbecab13';
    	$auth = '58a8116a9638ec3844c4fb200d448502';
    	// $from=SENDER_MESSAGE_BY;
		
		$api = curl_init("https://api.twilio.com/2010-04-01/Accounts/$sid/Messages.json");
        curl_setopt_array($api, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => array("Authorization: Basic ".base64_encode($sid.':'.$auth)),
            CURLOPT_POSTFIELDS => array(
                'Body' =>'Thanks for taking the medication  1',
                'To' =>'+12816104582',
                'From' => '+18338580112',
            )
        ));
    
		$resp = curl_exec($api);
        $resp=json_decode($resp, true);
        print_r($resp);

// 12816104582
// 18338580112

?>

