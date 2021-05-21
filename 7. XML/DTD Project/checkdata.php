<?php
$xml = new DOMdocument();
@$xml->load('output.xml');
if($xml->validate()){
	echo "Xml is validate";
}else{
	echo "xml is not validate";
}
?>