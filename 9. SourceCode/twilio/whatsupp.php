<?php

// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once 'Twilio/autoload.php';

use Twilio\Rest\Client;
//use Twilio\Twiml;

//$response = new Twiml;
//$response->say("Hello World!");

//header("content-type: text/xml");
//echo $response;



$sid    = "AC718517d46e2084778c32efbfcdb902a1";
$token  = "f693e844eb20ad53c2567bfcedebbbdd";
$twilio = new Client($sid, $token);

$message = $twilio->messages
                  ->create("whatsapp:+15005550006",
                           array(
                               "body" => "Hello there!",
                               "from" => "whatsapp:+14155238886"
                           )
                  );

print($message->sid);

?>