<?php
$parameters = array(
'auth_id'=>"477",
'auth_key'=>"fgddola1l536k",
'func'=>'send_sms',
'callerId' => "12625005334",
'toNumbers'=>"2623882988", 
'type'=>"text",
'template_id'=>"0", 
'message'=>'this is test message send by henrry'
);


/*****From  above all fields array user can use one array at a time to perform related action*****/
$ch = curl_init();
$url = 'https://sms.intercloud9.com/Services/apikey_webhook.php';
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($parameters));
curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
curl_close($ch);

echo "<pre>";
print_r($result);

/*
{
"response": "success",
"message": "Successfully sent.",
"sms_info": {
"log_id": 127969,
"limit_used": 1,
"contact_id": "19207168",
"sms_from": "12625005334",
"sms_to": "4074060353",
"sms_text": "This is test sms. Thank you!",
"direction": "outbound",
"type": "sms",
"dated": "2022-11-08 08:58:51"
}
}
*/


?>
