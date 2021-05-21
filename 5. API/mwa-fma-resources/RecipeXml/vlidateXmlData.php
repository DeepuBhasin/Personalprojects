<?php

$xml = new DOMDocument();
$xml->load('recipes.xml');
if($xml->schemaValidate('recipes.xsd')){
	echo "Xml is validate";
}else{
	echo "xml is not validate";
}


?>