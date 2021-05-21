<pre>
<?php
session_start();

// $url = "https://api.bigbuy.eu/rest/catalog/products.json?pageSize=0&page=0";
function apiData($urlAddress,$tokken){
	$url= $urlAddress;
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$headers = array(
	   "Accept: application/json",
	   "Authorization: Bearer $tokken",
	);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	//for debug only!
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	$resp = curl_exec($curl);
	curl_close($curl);
	$data=json_decode($resp,true);

	return $data;
}


/* product APi Start */
$url = "https://api.bigbuy.eu/rest/catalog/products.json?pageSize=0&page=0";

$tokken = "ZjQwNGQyNDJmYjA1NzhkOTAyM2U2ZmNhMTZiZmNiZTlhN2Y1ODgyOGNkNWI2MWVkYWZkNzEzYmJhY2ZkNjU4NA";

$returnProductData=apiData($url,$tokken);

$countReturnProductData=count($returnProductData);

 /* product Variation Api start */



// $url = "https://api.bigbuy.eu/rest/catalog/productsvariations.json?pageSize=0&page=0";
// $returnProductsVariationsData=apiData($url,$tokken);
// $countReturnProductsVariationsData=count($returnProductsVariationsData);
// /* product Variation Api start */


// $_SESSION['productsvariations']=$returnProductsVariationsData;
// print_r($returnProductsVariationsData);

for($i=0;$i<$countReturnProductData;$i++){
	if($returnProductData[$i]['category']=="3308"){
		$mainData[]['product']=$returnProductData[$i];
	}
}

// $countmainData=count($mainData);
print_r($mainData);



// for($i=0;$i<$countmainData;$i++){
	
// 	for($z=0;$z<$countReturnProductsVariationsData;$z++){

// 		if($mainData[$i]['product']['id']==$returnProductsVariationsData[$z]['product']){
// 			$mainData[$i]['product']['mainDetals']=$mainData[$z]['product'];
// 			$mainData[$i]['product']['variationDetails']=$returnProductsVariationsData[$z];
// 		}
		
// 	}	
// }

// print_r($mainData);

	

?>