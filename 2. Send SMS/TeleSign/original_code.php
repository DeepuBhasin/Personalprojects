<pre>
 <?php
  require __DIR__ . "/vendor/autoload.php";
  use telesign\sdk\messaging\MessagingClient;
  $customer_id = "59423267-12E1-4220-8717-F74F60841265";
  $api_key = "8aEVcSIE9DmNnTpUnOWnpRNXuJTIynBfOSoSB7dTm3/GLN32cJsvEgD7hx+lwVXP5pJ8a3j5a65Qa3y1A2rumw==";
  $phone_number = "+919915099247";
  $message = "You're scheduled for a dentist appointment at 2:30PM.";
  $message_type = "ARN";
  $messaging = new MessagingClient($customer_id, $api_key);
  $response = $messaging->message($phone_number, $message, $message_type);

  print_r($response);

  foreach($response as $a)
   {
      $x=$a;
    break;

   } 
   echo "<br/>";
   print_r($x);