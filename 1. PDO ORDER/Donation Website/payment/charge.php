<?php
  require_once('vendor/autoload.php');
  // require_once('config/db.php');
  // require_once('lib/pdo_db.php');
  // require_once('models/Customer.php');
  // require_once('models/Transaction.php');

\Stripe\Stripe::setApiKey('sk_live_b8z7Fo4PO51uqOUBthpG68a9005cLoFdDk');

 // Sanitize POST Array
  $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

  $first_name = $POST['first_name'];
  $last_name = $POST['last_name'];
  $email = $POST['email_id'];
  $amount = $POST['amount'];
  $address_1 = $POST['address_1'];
  $postal_code = $POST['postal'];
  $city = $POST['city'];
  $state = $POST['state'];
  $country = $POST['country'];
  // $token = $POST['token'];


// payment_intent Customer
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

// Create Customer In Stripe
$customer = \Stripe\Customer::create(array(
    "email" => $email,
    "source" => $token,
    'name' => $first_name,
    'address' => [
    'line1' => $address_1,
    'postal_code' => $postal_code,
    'city' => $city,
    'state' => $state,
    'country' => $country
    ],
   // "payment_method" => ["card"],
));


 echo json_encode(array('client_secret' => $payment_intent->client_secret));
 // echo $payment_intent->client_secret;

// Customer date_add()
// $customerData = [
//   'id' => $payment_intent->customer,
//   'first_name' => $first_name,
//   'last_name' => $last_name,
//   'email' => $email
// ];

// Instantiate Customer
// $customer = new Customer();

// // Add Customer To DB
// $customer->addCustomer($customerData);

// if(!isset($payment_intent->status))
// {
//   if($payment_intent->status!='succeeded')
//   {
//     header("Location:../index.html");
//     exit;  
//   }  
//   header("Location:../index.html");
//   exit;
// }  


// Transaction Data
// $transactionData = [
//   'id' => $payment_intent->id,
//   'customer_id' => $payment_intent->customer,
//   'product' => $payment_intent->description,
//   'amount' => $payment_intent->amount,
//   'currency' => $payment_intent->currency,
//   'status' => $payment_intent->status,
// ];

// Instantiate Transaction
// $transaction = new Transaction();

// // Add Transaction To DB
// $transaction->addTransaction($transactionData);

// // Redirect to success
// header('Location: success.php?tid='.$payment_intent->id.'&product='.$payment_intent->description);