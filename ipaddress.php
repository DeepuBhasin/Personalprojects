<pre>

<?php
// this code is only work on server
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.ipdata.co/100.128.0.9/carrier?api-key=test",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  var_dump($response);
}
?>