<pre>
<?php
$con = mysqli_connect('localhost','root','','all_demos');

$file = fopen("transactions_2021.csv","r");
while ($file) {

	$data = fgetcsv($file);

	$transaction_date = $data[0];
	$customer = $data[1];	
	$customer_name = $data[2];
	$country = $data[3];
	$product = $data[4];
	$product_name = $data[5];
	$platform = $data[6];
	$quantity = $data[7];
	$my_value = $data[8];
	



	$sql = "INSERT INTO transactions VALUES (NULL,'$transaction_date','$customer','$customer_name','$country','$product','$product_name','$platform', '$quantity','$my_value');";
	mysqli_query($con,$sql); 

};
fclose($file);
?>