<?php
add_action( 'woocommerce_payment_complete', 'create_muskeltool_user' );
function create_muskeltool_user( $order_id )
{
    $order = wc_get_order( $order_id );
	 foreach ( $order->get_items() as $item ) 
	 {
		if ( $item['product_id'] == 3449  ) {
			
        $order_data = $order->get_data(); // The Order data
	    $email = $order_data['billing']['email'];
        $first_name = $order_data['billing']['first_name'];

	    function randomPassword() 
	    {
		    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		    $pass = array(); //remember to declare $pass as an array
		    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		    for ($i = 0; $i < 8; $i++) {
		        $n = rand(0, $alphaLength);
		        $pass[] = $alphabet[$n];
		    }
		    return implode($pass); //turn the array into a string
		}
	
	define( 'DB_NAME', 'DB4342643' );
	define( 'DB_USER', 'DB4342643' );
	define( 'DB_PASSWORD', 'H5z%sZny75YFxMdU' );
	define( 'DB_HOST', 'localhost' );


	
	$conn = new mysqli(constant("DB_HOST"), constant("DB_USER"), constant("DB_PASSWORD"), constant("DB_NAME"));
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	function register_user($email=null,$vorname=null,$nachname=null)
	{
		global $conn;
	    $passwort = randomPassword();
		if (!empty($email))
		{ 
			$query = "INSERT into muskeltool_users (email,passwort,vorname,nachname) values ('$email','$passwort','$vorname','$nachname')";
			if ($conn->query($query)) 
			{
				$to      = $email;
				$subject = 'Muskeltool Zugang KAF Akademie';
				$message = 'Hallo '.  $vorname      . ",\r\n\r\n" .
				'im Folgenden erhältst du den Zugang zum Muskeltool:'       . "\r\n" .
				'Link: https://pages.kaf-akademie.de/muskeltool'       . "\r\n" .
				'Benutzername: '. $email       . "\r\n" .
				'Passwort: '.   $passwort    . "\r\n\r\n" .
				'Wir wünschen dir viel Erfolg beim Lernen. Bei technischen Fragen kannst du dich jederzeit bei 				uns melden.'   . "\r\n\r\n" .
				'Liebe Grüße'       . "\r\n" .
				'Dein Team der KAF Akademie';
				$headers = 'From: info@kaf-akademie.de'       . "\r\n" .
							 'Reply-To: info@kaf-akademie.de' . "\r\n" .
							 'X-Mailer: PHP/' . phpversion();

				mail($to, $subject, $message, $headers);
			}
		}
	}

	register_user($email,$vorname,$nachname);



	
	$conn->close();	


        }
    }
}

?>