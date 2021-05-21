<?php
$data = [
    'phone' => '9197800384', // Receivers phone
    'body' => 'Hello, Andrew!', // Message
];
$json = json_encode($data); // Encode data to JSON
// URL for request POST /message
$token = '83763g87x';
$instanceId = '777';
$url = 'https://api.chat-api.com/instance'.$instanceId.'/message?token='.$token;
// Make a POST request
$options = stream_context_create(['http' => [
        'method'  => 'POST',
        'header'  => 'Content-type: application/json',
        'content' => $json
    ]
]);
// Send a request
$result = file_get_contents($url, false, $options);