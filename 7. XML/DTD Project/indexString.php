<pre>
<?php

$date='03/11/2019';
$giftshop='3';

$con = mysqli_connect('localhost','root','','xmldata');
$sql = "SELECT t.*,c.* FROM transactiondate as t INNER JOIN customerdata as c ON c.customerID=t.customerID WHERE t.giftShop='$giftshop' and t.transaction_date='$date' ORDER BY `t`.`transaction_date` ASC";
$result = mysqli_query($con,$sql);
echo htmlentities('<date transaction_date="'.$date.'">');
while($row=mysqli_fetch_assoc($result)){
echo htmlentities('
	 <transactionDetails>
	 	<transaction>
	 		<transaction_id>"'.$row['transactionID'].'"</transaction_id>
	 		<value currency="gbp">'.$row['value'].'</value>
	 	</transaction>
		<customer>
		 	<prefix>"'.$row['prefix'].'"</prefix>
		 	<lastName>"'.$row['lastName'].'"</lastName>
		 	<givenName>"'.$row['givenName'].'"</givenName>
		 	<addressID>"'.$row['addressID'].'"</addressID>
		 	<customerID>"'.$row['customerID'].'"</customerID>
	 	</customer>
	 </transactionDetails>');
}
echo htmlentities('</date>');

?>	