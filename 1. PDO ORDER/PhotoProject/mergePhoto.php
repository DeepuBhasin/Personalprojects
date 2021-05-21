<?php
session_start(); 
if (!isset($_POST['select']) || !isset($_SESSION['imageName']) || !isset($_SESSION['teacherId'])) {
   header('location:index.php?status=error&message=Access Denied');
}
  include '__database.php';
  include '__gettingValue.php';
 
        function correctImageOrientation($filename)
        {
            $exif = exif_read_data($filename);
            if ($exif && isset($exif['Orientation'])) {
                $orientation = $exif['Orientation'];
                if ($orientation != 1) {
                    $img = imagecreatefromjpeg($filename);
                    $deg = 0;
                    switch ($orientation) {
                        case 3:
                            $deg = 180;
                            break;
                        case 6:
                            $deg = 270;
                            break;
                        case 8:
                            $deg = 90;
                            break;
                    }
                    if ($deg) {
                        $img = imagerotate($img, $deg, 0);
                    }
                    imagejpeg($img, $filename, 95);
                }
            }
        }
        correctImageOrientation($uploadedImage);





      if($cropImage==1){
          
          $image_s  = imagecreatefromstring(file_get_contents($uploadedImage));
          
          $width = imagesx($image_s);
          
          $height = imagesy($image_s);  
          
          
          $newWidth = $imageWidth;
        
          $newHeight =$imageHeight;
          
          $image = imagecreatetruecolor($newWidth,$newHeight);
          
          imagealphablending($image,true);
          
          imagecopyresampled($image, $image_s, 0, 0, 0, 0, $newWidth, $newHeight, $width,$height);

          $mask = imagecreatetruecolor($newWidth, $newHeight);
          
          $transparent = imagecolorallocate($mask, 255,0,0);
          
          imagecolortransparent($mask,$transparent);

          imagefilledellipse($mask,$newWidth/2,$newHeight/2,$newWidth,$newHeight,$transparent);

          $red = imagecolorallocate($mask, 0, 0, 0);
          
          imagecopymerge($image, $mask, 0, 0, 0, 0, $newWidth, $newHeight, 100);
          
          imagecolortransparent($image,$red);
          
          imagefill($image, 0, 0, $red);
          
          // header('Content-Type: image/png');
          // imagepng($image);
          // exit;

          imagepng($image,'images/created/'.$_SESSION['imageName']);
          imagedestroy($image);
          imagedestroy($mask);



          // list($width,$height) = getimagesize($uploadedImage);
          $image1 = imagecreatefromstring(file_get_contents($templateImage));
          $image2 = imagecreatefromstring(file_get_contents('images/created/'.$_SESSION['imageName']));


          imagecopymerge($image1, $image2,$imageX,$imageY, 0, 0, $newWidth, $newHeight,100);
          
          $img  = 'images/created/'.$_SESSION['imageName'];
          
          
          imagepng($image1,$img);
          

          // header('Content-type:image/png');
          // imagepng($image1);
          // exit;
          
          // Create Image From Existing File
          $jpg_image = imagecreatefrompng($img);

          // Allocate A Color For The Text
          $white = imagecolorallocate($jpg_image,  0,0,0);

          // Set Path to Font File
          $font_path = 'public/Calibri Bold Italic.ttf';

          // Set Text to Be Printed On Image
          // $text = "This is a sunset!";
          

          // Print Text On Image
          imagettftext($jpg_image, 35, 0, $dearX,$dearY, $white, $font_path, ucwords($teacherName));
          imagettftext($jpg_image, 25, 0, $fromX,$fromY, $white, $font_path, ucwords($studentName));
          imagettftext($jpg_image, 25, 0, $classX,$classY, $white, $font_path, ucwords($teacherClass));
          imagettftext($jpg_image, 25, 0, $cityX,$cityY, $white, $font_path, ucwords($teacherCity));

          if($mobileX!='' && $mobileY!=''){
            imagettftext($jpg_image, 25, 0, $mobileX,$mobileY, $white, $font_path, ucwords($teacherMobile));          
          }
          if($dateX!='' && $dateY!=''){
            $now = new DateTime();
            $now->setTimezone(new DateTimezone('Asia/Calcutta'));
            $get_time= $now->format('Y-m-d H:i:s');

            imagettftext($jpg_image, 25, 0, $dateX,$dateY, $white, $font_path, $get_time);          
          }

          $_SESSION['downloadImage'] = $_SESSION['imageName'];
           $img  = 'images/created/'.$_SESSION['downloadImage'];
          // Send Image to Browser
          imagepng($jpg_image,$img);

          // Clear Memory
          imagedestroy($jpg_image);

          unset($_SESSION['imageWidth']);
          
          header('location:download.php');

          
        
      }else {
        
      
         // creating new image which is resized 
        list($width,$height) = getimagesize($uploadedImage);
        $newWidth = $imageWidth;
        $newHeight =$imageHeight;

        $newImage = imagecreatetruecolor($newWidth,$newHeight);
        $oldSrc = @imagecreatefromjpeg($uploadedImage);
        imagecopyresized($newImage,$oldSrc,0,0,0, 0, $newWidth, $newHeight, $width, $height);
        $resizedImagePath = $_SESSION['imageName'];
        imagejpeg($newImage,'images/upload/'.$resizedImagePath);
        // end code of resize

        // merging two images  + adding text 
      // header('Content-Type: image/jpeg');
      $dest = imagecreatefromjpeg($templateImage);
      $src = imagecreatefromjpeg('images/upload/'.$_SESSION['imageName']);


        

        // Allocate A Color For The Text
        $white = imagecolorallocate($dest,0,0,0);

        // Set Path to Font File
        $font_path = 'public/Calibri Bold Italic.ttf';

        // Print Text On Image
        imagettftext($dest, 35, 0, $dearX,$dearY, $white, $font_path, ucwords($teacherName));
        imagettftext($dest, 25, 0, $fromX,$fromY, $white, $font_path, ucwords($studentName));
        imagettftext($dest, 25, 0, $classX,$classY, $white, $font_path, ucwords($teacherClass));
        imagettftext($dest, 25, 0, $cityX,$cityY, $white, $font_path, ucwords($teacherCity));

        if($mobileX!='' && $mobileY!=''){
          imagettftext($dest, 25, 0, $mobileX,$mobileY, $white, $font_path, ucwords($teacherMobile));          
        }
        if($dateX!='' && $dateY!=''){
          imagettftext($dest, 25, 0, $dateX,$dateY, $white, $font_path, ucwords($teacherMobile));          
        }
        

        imagealphablending($dest, false);
        imagesavealpha($dest, true);


          // merging two images 
        imagecopymerge($dest, $src,$imageX,$imageY,0,0,$newWidth,$newHeight,100); 
        $_SESSION['downloadImage'] = $studentId.'-'.time().'.jpeg';
        $img  = 'images/created/'.$_SESSION['downloadImage'];
        imagejpeg($dest,$img);

        imagedestroy($dest);
        imagedestroy($src);
        // end of merging two images
         header('location:download.php');
      }
?>