<?php

// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once 'Twilio/autoload.php';

use Twilio\Rest\Client;

// Find your Account Sid and Auth Token at twilio.com/console
$sid    = "AC718517d46e2084778c32efbfcdb902a1";
$token  = "f693e844eb20ad53c2567bfcedebbbdd";
$twilio = new Client($sid, $token);

$call = $twilio->calls
               ->create("+918007774544", // to
                        "+19528005142", // from
                        array("url" => "http://ishawebhosting.com/twilio/test.xml")
               );

print($call->sid);

?>