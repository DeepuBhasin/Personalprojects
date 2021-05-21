<?php
if(isset($_POST['session_variable']))
{
  echo "<pre>";
  // print_r($_POST);
  // exit;

   require_once('vendor/autoload.php');
   \Stripe\Stripe::setApiKey('sk_test_LiV61uydXLYAslbbUU3oaRiT00SEXNmNLs');

   // Sanitize POST Array
   $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

   $first_name = $POST['first_name'];
   $last_name = $POST['last_name'];
   $email = $POST['email'];
   $amount = $POST['amount'];
   $address_1 = $POST['address_1'];
   $postal_code = $POST['postal_code'];
   $city = $POST['city'];
   $state = $POST['state'];
   $country = $POST['country'];
   $token = $POST['stripeToken'];

  // Create Customer In Stripe
 try{
     $customer = \Stripe\Customer::create(array(
      "email" => $email,
      "source" => $token,
      'name' => $first_name.$last_name,
      'address' => [
          'line1' => $address_1,
          'postal_code' => $postal_code,
          'city' => $city,
          'state' => $state,
          'country' => $country,
        ]
      ));

          

    // Charge Customer
      // $charge = \Stripe\Charge::create(array(
      //   "amount" => $amount."00",
      //   "currency" => "usd",
      //   "description" => "Donation Money",
      //   "customer" => $customer->id,

      //   'shipping'=>[
      //       'name' => $first_name.$last_name,
      //       'address' => [
      //       'line1' => $address_1,
      //       'postal_code' => $postal_code,
      //       'city' => $city,
      //       'state' => $state,
      //       'country' => $country,
      //       ]
      //     ]
      // ));

      $payment_intent = \Stripe\PaymentIntent::create([
        "amount" => $amount."00",
        "currency" => "usd",
        "description" => "Donation Money",
        'payment_method_types' => ['card'],
        // "customer" => $customer->id,

        // 'shipping'=>[
        //     'name' => $first_name.$last_name,
        //     'address' => [
        //     'line1' => $address_1,
        //     'postal_code' => $postal_code,
        //     'city' => $city,
        //     'state' => $state,
        //     'country' => $country,
        //     ]
        //   ]
      ]); 
      // $PaymentMethod = \Stripe\PaymentMethod::create([
      //     'type' => 'card',
      //     'card' => [
      //       'number' => '4242424242424242',
      //       'exp_month' => 4,
      //       'exp_year' => 2021,
      //       'cvc' => '314',
      //     ],
      //   ]); 

      print_r($payment_intent);

    // if($charge->status=='succeeded')
    // {
    //   echo "Transaction Success.";
    //   // header("location:index.php?message=success");
    // }
    // else
    // {
    //   echo "Transaction Fail.";

    //   // header("location:index.php?message=fail");
    // }  
  }
  catch(Exception $e) 
  {
    echo 'Message: ' .$e->getMessage();
     // header("location:index.php?message=fail&&error=".$e->getMessage());
  }
}
else
{
  echo "fail";
  // header("location:index.php?message=para_fail&&error=".$e->getMessage());
}
