<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure HTTP basic authorization: basicAuth
$config = Karix\Configuration::getDefaultConfiguration()
    ->setUsername('fdc4cc28-2ce7-43a5-8d36-494ff3b9efb5')
    ->setPassword('f280b6ff-893d-49fe-88b1-44d2bf36c83e');

$apiInstance = new Karix\Api\MessageApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
date_default_timezone_set('UTC');
// Create Message object
$message = (new \Karix\Model\CreateMessage())
    ->setChannel("sms") //Or use "whatsapp"
    ->setSource("GIGOBIBO")
    ->setDestination(["+919915099247"])
    ->setContent(["text" => "testing message"]);

try {
    $result = $apiInstance->sendMessage($message);
    echo "<pre>";
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MessageApi->sendMessage: ', $e->getMessage(), PHP_EOL;
}
?>