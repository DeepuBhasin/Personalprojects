<?php
session_start();
//Set the Content Type
header('Content-type: image/png');

// Create Image From Existing File
$jpg_image = imagecreatefrompng('temp/test.png');

// Allocate A Color For The Text
$white = imagecolorallocate($jpg_image,  0,0,0);

// Set Path to Font File
$font_path = 'myfont.ttf';

// Set Text to Be Printed On Image
// $text = "This is a sunset!";
$text=$_SESSION['name'];

// Print Text On Image
imagettftext($jpg_image, 15, 0, 30,40, $white, $font_path, $text);

// Send Image to Browser
imagepng($jpg_image);

// Clear Memory
imagedestroy($jpg_image);
?>