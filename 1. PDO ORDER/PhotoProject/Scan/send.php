<?php
if(isset($_POST['submitImage']))
{
	session_start();
	$data = $_POST['imageName'];
	
	
	$data = str_replace('data:image/png;base64,', '', $data);

	$data = str_replace(' ', '+', $data);

	$data = base64_decode($data);

	$time = time();
	$filename = $_SESSION['studentId'].'-'.$time;
	
	file_put_contents('images/'.$filename.'.png', $data);
	
	$image = imagecreatefrompng('images/'.$filename.'.png');
	$bg = imagecreatetruecolor(imagesx($image), imagesy($image));
	imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
	imagealphablending($bg, TRUE);
	imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
	imagedestroy($image);
	$quality = 100; // 0 = worst / smaller file, 100 = better / bigger file 
	imagejpeg($bg, '../images/upload/'.$filename . ".jpeg", $quality);
	imagedestroy($bg);

	$_SESSION['imageWidth']=1;
	
	$_SESSION['imageName']=$filename.".jpeg";
	header('location:../selectTemplate.php');

}	

?>