<pre>
<?php
$con = mysqli_connect('localhost','root','','all_demos');

$file = fopen("products_2021.csv","r");
while ($file) {

	$data = fgetcsv($file);

	$product = $data[0];
	$sku = $data[1];	
	$sku2 = $data[2];
	$product_component = $data[3];
	$product_item = $data[4];
	$solution_area = $data[5];
	$environment_group = $data[6];
	$environment = $data[7];
	$external_level1 = $data[8];
	$external_level2 = $data[9];
	$development_group = $data[10];



	$sql = "INSERT INTO products VALUES (NULL, '$product', '$sku', '$sku2', '$product_component', '$product_item', '$solution_area', '$environment_group', '$environment', '$external_level1', '$external_level2', '$development_group');";
	mysqli_query($con,$sql);  
};
fclose($file);
?>