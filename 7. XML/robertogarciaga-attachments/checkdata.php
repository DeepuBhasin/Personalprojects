<?php
$xml = new DOMdocument();
@$xml->load('xml_file.xml');
if($xml->validate()){
	echo "Xml is validate";
}else{
	echo "xml is not validate";
}
?>