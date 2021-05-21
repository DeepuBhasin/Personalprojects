<?php
  
  header('Content-type: image/jpeg');				// creaing html page into image calling this function 
  
  $font_size=30;
  $image_width=200;
  $image_height=40;

  $image=imagecreate($image_width,$image_height);
  imagecolorallocate($image, 255,255,255);

	$textcolor = imagecolorallocate($image, 0, 0, 0);
  
  $font_file = 'myfont.ttf';
  
  // $custom_text = "Watermark Text";
  
  imagettftext($image, $font_size, 0, 15, 30, $textcolor, $font_file, rand(1000,9999));
 
  
  imagejpeg($image);
 
  imagedestroy($image); // for clearing memory
?>