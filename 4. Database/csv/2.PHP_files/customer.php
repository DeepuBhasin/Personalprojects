<pre>
<?php
$con = mysqli_connect('localhost','root','','all_demos');

$file = fopen("customers_2021.csv","r");
while ($file) {

	$data = fgetcsv($file);

	$site = $data[0];
	$company_name = $data[1];
	$address = $data[2];	
	$city = $data[3];
	$state = $data[4];
	$zipcode = $data[5];
	$country = $data[6];
	$suggested_company = $data[7];
	$industry_code = $data[8];
	$industry_vertical = $data[9];
	$parent_company = $data[10];
	$parent_industry_code = $data[11];
	$parent_vertical = $data[12];



	$sql = "INSERT INTO customers  VALUES (NULL, '$site', '$company_name', '$address', '$city', '$state', '$zipcode', '$country', '$suggested_company', '$industry_code', '$industry_vertical', '$parent_company', '$parent_industry_code', '$parent_vertical');";
	mysqli_query($con,$sql);
	  
};
fclose($file);
?>