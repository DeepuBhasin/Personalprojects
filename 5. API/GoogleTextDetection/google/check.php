<?php
session_start();
require 'vendor/autoload.php';

use Google\Cloud\Vision\VisionClient;

$Vision = new VisionClient(['keyFile' => json_decode(file_get_contents('key.json'), true)]);

$familyPhotoResourse = fopen($_FILES['image']['tmp_name'], 'r');

// $image = $Vision->image($familyPhotoResourse, ['TEXT_DETECTION','FACE_DETECTION','WEB_DETECTION','LABEL_DETECTION','iMAGE_PROPERTIES','SAFE_SEARCH_DETECTION','LANDMARK_DETECTION','LOGO_DETECTION']);


$image = $Vision->image($familyPhotoResourse, ['TEXT_DETECTION']);

$result = $Vision->annotate($image);

if ($result) {
    $imageToken = random_int(111111, 9999999);
    move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $imageToken . '.jpg');
} else {
    header('location:index.php');
    die();
}



// $faces=$result->faces();
// $logos=$result->logos();
// $labels=$result->labels();
// $text=$result->text();
// $fullText=$result->fullText();
// $imageProperties=$result->imageProperties();
// $cropHints=$result->cropHints();
// $web=$result->web();
// $safeSearch=$result->safeSearch();
// $landmarks=$result->landmarks();


$text=$result->text();
$fullText=$result->fullText();

echo '<pre>';
print_r($text);
// print_r($fullText);
exit;

foreach($text as $newtext){
    print_r($newtext->info());
}
?>
