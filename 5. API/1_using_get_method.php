<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>
<h1>All Active Project list</h1>

<pre>
<?php
$url = 'https://tree-nation.com/api/projects?status=active';
$crl = curl_init();

curl_setopt($crl, CURLOPT_URL, $url);
curl_setopt($crl, CURLOPT_FRESH_CONNECT, true);
curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($crl);

if (!$response) {
    die('Error: "' . curl_error($crl) . '" - Code: ' . curl_errno($crl));
}

curl_close($crl);
$response = json_decode($response, true);
print_r($response);