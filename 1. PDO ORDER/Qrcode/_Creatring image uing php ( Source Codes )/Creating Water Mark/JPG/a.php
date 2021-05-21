<?php
//Set the Content Type
header('Content-type: image/jpeg');

// Create Image From Existing File
$jpg_image = imagecreatefromjpeg('1.JPG');

// Allocate A Color For The Text
$white = imagecolorallocate($jpg_image, 255,255,0);

// Set Path to Font File
$font_path = 'myfont.ttf';

// Set Text to Be Printed On Image
$text = "This is a sunset!";

// Print Text On Image
imagettftext($jpg_image, 20, 0, 88, 300, $white, $font_path, $text);

// Send Image to Browser
imagejpeg($jpg_image);

// Clear Memory
imagedestroy($jpg_image);
?>