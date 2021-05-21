<pre>
<?php
$url = "https://api.bigbuy.eu/rest/catalog/products.json?pageSize=0&page=0";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Accept: application/json",
   "Authorization: Bearer ZjQwNGQyNDJmYjA1NzhkOTAyM2U2ZmNhMTZiZmNiZTlhN2Y1ODgyOGNkNWI2MWVkYWZkNzEzYmJhY2ZkNjU4NA",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$resp = curl_exec($curl);
curl_close($curl);
print_r(json_decode($resp,true));

?>
