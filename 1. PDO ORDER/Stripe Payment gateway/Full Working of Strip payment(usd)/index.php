<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Pay Page</title>
</head>
<body>
  <div class="container">
    <h2 class="my-4 text-center">Fill the following Details </h2>
    <form action="./charge.php" method="post" id="payment-form">
      <div class="form-row">
       <input type="hidden" name="session_variable" value="yes" >
       <label for="first_name">First Name</label>
       <input type="text" name="first_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Enter First Name" required="">
       <label for="last_name">Last Name</label>
       <input type="text" name="last_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Enter Last Name" required="">
       <label for="email">Email Address</label>
       <input type="email" name="email" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Email Address" required="">
       <label for="amount">Donation Amount</label>
       <input type="number" name="amount" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Enter Amount" required="" min="1" minlength="1">


       <label for="address">Address</label>
       <input type="text" name="address_1" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Enter Address" required="">
       <label for="postal_code">Postal Code</label>
       <input type="number" name="postal_code" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Last Name" required="">
       <label for="city">City</label>
       <input type="text" name="city" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Enter City" required="">
       <label for="state">State</label>
       <input type="text" name="state" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Enter State" required="">
       <label for="Country">Country (Enter 2 letter Alpha Code of Country)</label>
       <input type="text" name="country" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Enter Country" required="" maxlength="2" minlength="2">
       

       <label for="card-element">
        Credit or debit card
      </label>
        <div id="card-element" class="form-control">
          <!-- a Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors -->
        <div id="card-errors" role="alert"></div>
      </div>

      <button>Submit Payment</button>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="./js/charge.js"></script>
</body>
</html>