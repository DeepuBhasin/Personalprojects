<?php

// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once 'Twilio/autoload.php';

use Twilio\Rest\Client;

// Find your Account Sid and Auth Token at twilio.com/console
$sid    = "AC718517d46e2084778c32efbfcdb902a1";
$token  = "f693e844eb20ad53c2567bfcedebbbdd";
$twilio = new Client($sid, $token);

$message = $twilio->messages
                  ->create("+918007774544", // to
                           array(
                               "body" => "This is the ship that made the Kessel Run in fourteen parsecs?",
                               "from" => "+19528005142"
                           )
                  );

print($message->sid);

?>