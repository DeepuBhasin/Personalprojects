<?php
if(isset($_POST['session_variable']))
{
   require_once('vendor/autoload.php');
   \Stripe\Stripe::setApiKey('sk_test_LiV61uydXLYAslbbUU3oaRiT00SEXNmNLs');

   // Sanitize POST Array
   $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

   $first_name = $POST['first_name'];
   $last_name = $POST['last_name'];
   $email = $POST['email'];
   $amount = $POST['amount'];
   $token = $POST['stripeToken'];

  // Create Customer In Stripe
 try{
     $customer = \Stripe\Customer::create(array(
      "email" => $email,
      "source" => $token,
    ));

     

    // Charge Customer
      $charge = \Stripe\Charge::create(array(
        "amount" => $amount."00",
        "currency" => "inr",
        "description" => "Donation Money",
        "customer" => $customer->id
      ));


    
    if($charge->status=='succeeded')
    {
      echo "Transaction Success.";
      // header("location:index.php?message=success");
    }
    else
    {
      echo "Transaction Fail.";

      // header("location:index.php?message=fail");
    }  
  }
  catch(Exception $e) 
  {
    echo 'Message: '.$e->getMessage();
     // header("location:index.php?message=fail&&error=".$e->getMessage());
  }
}
else
{
  echo "fail";
  // header("location:index.php?message=para_fail&&error=".$e->getMessage());
}
