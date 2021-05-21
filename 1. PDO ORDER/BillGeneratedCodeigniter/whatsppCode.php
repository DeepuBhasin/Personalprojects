<?php
 //http://chat-api.phphive.info/login/gui

$chatApiToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE2MjM1NjE2NTAsInVzZXIiOiI5MTk1OTcwODE3ODkifQ.3YosWmlCkP0EYG4wbHMy1BU5z7Rb2PW59U-iOyOE1hE";
 
$number = "+919915099247"; // Number
$number = str_replace("+","",$number);
$message = "hello whats app"; // Message
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://chat-api.phphive.info/message/send/text',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>json_encode(array("jid"=> $number."@s.whatsapp.net", "message" => $message)),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$chatApiToken,
    'Content-Type: application/json'
  ),
));
 
$response = curl_exec($curl);
curl_close($curl);
$response = json_decode($response,true);
echo "<pre>";
print_r($response);	
// print_r($response['error']); // for checking error;
// print_r($response['response']); // for checking error;