<pre>
<?php
$url = "https://api.sandbox.bigbuy.eu/rest/catalog/attributes.json?isoCode=el&pageSize=0&page=0";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Accept: application/json",
   "Authorization: Bearer Mzk2YWNiNjIyNDEzMDBiYzRlOGJkNmEzZjNmZjg1MDJkMmFlNzljYzAzNjA1YWVlMTNjMDE1MzI0ZDIyYzcxMA",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$resp = curl_exec($curl);
curl_close($curl);
print_r(json_decode($resp,true));

?>