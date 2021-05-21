<?php

require 'vendor/autoload.php';

use Google\Cloud\Vision\VisionClient;

$Vision=new VisionClient(['keyFile'=>json_decode(file_get_contents('key.json'),true)]);

$familyPhotoResourse=fopen('w.jpg','r');

$image=$Vision->image($familyPhotoResourse,['FACE_DETECTION','WEB_DETECTION']);

$result=$Vision->annotate($image);

echo '<pre>';
var_dump($result);


?>