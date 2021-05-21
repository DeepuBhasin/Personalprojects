<?php
// if(!isset($_POST['amount']))
// {
//   if($_POST['amount']!='yes')
//    {
//       header("location:../index.html");
//    }

//    header("location:../index.html"); 
// }

require_once('vendor/autoload.php');
\Stripe\Stripe::setApiKey('sk_live_b8z7Fo4PO51uqOUBthpG68a9005cLoFdDk');

$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

$first_name = $POST['first_name'];
$last_name = $POST['last_name'];
$email_id = $POST['email_id'];
$amount = $POST['amount'];
$address_1 = $POST['address_1'];
$postal_code = $POST['postal'];
$city = $POST['city'];
$state = $POST['state'];
$country = $POST['country'];
// $token = $POST['token'];

$payment_intent =\Stripe\PaymentIntent::create([ 
  'amount' =>$amount."00",
  'currency' => 'usd', 
  'description'=>'Donation Money',
  'shipping'=>[
    'name' => $first_name,
      'address' => [
      'line1' => $address_1,
      'postal_code' => $postal_code,
      'city' => $city,
      'state' => $state,
      'country' => $country
      ]
   ],
  'metadata' => ['integration_check' => 'accept_a_payment'],
  'payment_method_types'=>['card']
  ]);

  $customer = \Stripe\Customer::create(array(
    "email" => $email_id,
    // "source" => $token,
    'name' => $first_name,
    'address' => [
    'line1' => $address_1,
    'postal_code' => $postal_code,
    'city' => $city,
    'state' => $state,
    'country' => $country
    ],
   "payment_method" => ["card"],
));
  
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Pay Page</title>
</head>

<body>
    <div class="container">
        <h2 class="my-4 text-center">Please Enter Following Details for Donation</h2>
        <input type="hidden" id="sk_key" name="sk_key" value="<?= $payment_intent->client_secret;?>">
        <form id="payment-form">
            <div class="form-row">


                <div id="card-element" class="form-control">
                    <!-- a Stripe Element will be inserted here. -->
                </div>

                <!-- Used to display form errors -->
                <div id="card-errors" role="alert"></div>
            </div>

            <button id="submit">Submit Payment</button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="./js/charge.js"></script>
</body>

</html>