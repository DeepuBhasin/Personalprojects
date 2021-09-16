<?php
require'vendor/autoload.php';

use GuzzleHttp\Client;
$client = new Client();
$response = $client->get('https://87.26.175.50:9091/v1.0/prices',[
    'auth' => ['clayton@polaradventure.com', '30EnI9gC7#94z#0B', 'digest'],'verify' => false

]);
$document = $response->json();

	require('__db.php');

	$query="TRUNCATE ship_json_auth_table;";
	mysqli_query($con,$query);
	

	$sql='';
	$c=0;

	$starting = microtime(true);
	
		foreach($document as $key=>$value)
		{
			$mainData=[
				'voyageId'=>$value['voyageId'],
				'voyageCod'=>$value['voyageCod'],	
				];

				foreach ($value['marketCurrency'][0]['promotions'] as $key2=>$value2) {
					$promotion_data=[
						'voyageId'=>$mainData['voyageId'],
						'voyageCod'=>$mainData['voyageCod'],
						'price_voyageId'=>$value2['voyageId'],
						'fare'=>$value2['fare'],
						'promoID'=>$value2['promoID'],
						'promoDesc'=>$value2['promoDesc'],
						'validityDateFrom'=>$value2['validityDateFrom'],
						'validityDateTo'=>$value2['validityDateTo'],
						'isManual'=>$value2['isManual'],
						'coFlag'=>$value2['coFlag'],
						'asFlag'=>$value2['asFlag'],
						'productCod'=>$value2['productCod'],
						'itemCod'=>$value2['itemCod'],
						'itemDesc'=>$value2['itemDesc'],
						'itemPrice'=>$value2['itemPrice'],
						'firstPaxOnlyFlag'=>$value2['firstPaxOnlyFlag'],
						'firstAndSecondPaxFlag'=>$value2['firstAndSecondPaxFlag'],
						'thirdAndFourthPaxFlag'=>$value2['thirdAndFourthPaxFlag'],
						'groupCod'=>$value2['groupCod'],
						'promoType'=>$value2['promoType'],
					];
				

				foreach ($value['marketCurrency'][0]['cruiseOnlyPrices'] as $key1=>$value1) {
					$data=[
						(!empty($promotion_data['voyageId'])) ? $promotion_data['voyageId'] : 0,
						(!empty($promotion_data['voyageCod'])) ? $promotion_data['voyageCod'] : 0,
						(!empty($value1['suiteCategoryCod'])) ? $value1['suiteCategoryCod'] : 0,
						(!empty($value1['suiteCategory'])) ? $value1['suiteCategory'] : 0,
						(!empty($value1['currencyCod'])) ? $value1['currencyCod'] : 0,
						(!empty($value1['cruiseOnlyFare'])) ? $value1['cruiseOnlyFare'] : 0,
						(!empty($value1['bundleFare'])) ? $value1['bundleFare'] : 0,
						(!empty($value1['earlyBookingBonus'])) ? $value1['earlyBookingBonus'] : 0,
						(!empty($value1['earlyBookingPerc'])) ? $value1['earlyBookingPerc'] : 0,
						(!empty($value1['suiteAvailability'])) ? $value1['suiteAvailability'] : 0,
						(!empty($value1['singleSupplementPerc'])) ? $value1['singleSupplementPerc'] : 0,
						(!empty($value1['hasLoyaltySaving'])) ? $value1['hasLoyaltySaving'] : 0,
						(!empty($value1['loyaltySaving'])) ? $value1['loyaltySaving'] : 0,	
						 0,
						(!empty($promotion_data['price_voyageId'])) ? $promotion_data['price_voyageId'] : 0,
						(!empty($promotion_data['fare'])) ? $promotion_data['fare'] : 0,
						(!empty($promotion_data['promoID'])) ? $promotion_data['promoID'] : 0,
						(!empty($promotion_data['promoDesc'])) ? $promotion_data['promoDesc'] : 0,
						(!empty($promotion_data['validityDateFrom'])) ? $promotion_data['validityDateFrom'] : 0,
						(!empty($promotion_data['validityDateTo'])) ? $promotion_data['validityDateTo'] : 0,
						(!empty($promotion_data['isManual'])) ? $promotion_data['isManual'] : 0,
						(!empty($promotion_data['coFlag'])) ? $promotion_data['coFlag'] : 0,
						(!empty($promotion_data['asFlag'])) ? $promotion_data['asFlag'] : 0,
						(!empty($promotion_data['productCod'])) ? $promotion_data['productCod'] : 0,
						(!empty($promotion_data['itemCod'])) ? $promotion_data['itemCod'] : 0,
						(!empty($promotion_data['itemDesc'])) ? $promotion_data['itemDesc'] : 0,
						(!empty($promotion_data['itemPrice'])) ? $promotion_data['itemPrice'] : 0,
						(!empty($promotion_data['firstPaxOnlyFlag'])) ? $promotion_data['firstPaxOnlyFlag'] : 0,
						(!empty($promotion_data['firstAndSecondPaxFlag'])) ? $promotion_data['firstAndSecondPaxFlag'] : 0,
						(!empty($promotion_data['thirdAndFourthPaxFlag'])) ? $promotion_data['thirdAndFourthPaxFlag'] : 0,
						(!empty($promotion_data['groupCod'])) ? $promotion_data['groupCod'] : 0,
						(!empty($promotion_data['promoType'])) ? $promotion_data['promoType'] : 0,
					];
					
					$sql= "INSERT into  ship_json_auth_table values(null,'{$data[0]}','{$data[1]}','{$data[2]}','{$data[3]}','{$data[4]}','{$data[5]}','{$data[6]}','{$data[7]}','{$data[8]}','{$data[9]}','{$data[10]}','{$data[11]}','{$data[12]}','{$data[13]}','{$data[14]}','{$data[15]}','{$data[16]}','{$data[17]}','{$data[18]}','{$data[19]}','{$data[20]}','{$data[21]}','{$data[22]}','{$data[23]}','{$data[24]}','{$data[25]}','{$data[26]}','{$data[27]}','{$data[28]}','{$data[29]}','{$data[30]}','{$data[31]}');";	
					$check=mysqli_query($con,$sql);
					if($check){
						$success=true;
						$c++;
					}
					if(!$check){
						$success = false;
					}
				}
			}	
		}

	if($success){
       	echo "SUCCESS: $c Record Added Successfully <br/> Program Take Time for Completion : ".((microtime(true)-$starting)/60).' minutes'; 
       }else{
       	echo mysqli_error($con);
       }
	

?>
