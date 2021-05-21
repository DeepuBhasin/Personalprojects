<?php
 //starting  Getting values from database of particular template
    
    $templateId = mysqli_real_escape_string($conn,htmlentities($_POST['templateId'])); 

    $sql1 = "SELECT * FROM  imagetemplates where id=$templateId";   
    $query = mysqli_query($conn,$sql1);

    $row = mysqli_fetch_all($query,MYSQLI_ASSOC)[0];

    

    $id             = $row['id'];
    $nameImage      = $row['nameImage'];
    $headerName     = $row['headerName'];
    $imageWidth     = $row['imageWidth'];
    $imageHeight    = $row['imageHeight'];
    $imageX         = $row['imageX'];
    $imageY         = $row['imageY'];
    $dearX          = $row['dearX'];
    $dearY          = $row['dearY'];
    $fromX          = $row['fromX'];
    $fromY          = $row['fromY'];
    $classX         = $row['classX'];
    $classY         = $row['classY'];
    $cityX          = $row['cityX'];
    $cityY          = $row['cityY'];
    $mobileX        = $row['mobileX'];
    $mobileY        = $row['mobileY'];
    $dateX          = $row['dateX'];
    $dateY         = $row['dateY'];
    $cropImage         = $row['cropImage'];

    //End Code  Getting values from database of particular template
      
      $templateImage = 'images/templates/'.$nameImage;
      $uploadedImage = 'images/upload/'.$_SESSION['imageName'];
      
      $studentId = $_SESSION['studentId'];


      $sql1 = "SELECT studentName FROM studendetails where studentId=$studentId";
      
      $studentName = mysqli_fetch_assoc(mysqli_query($conn,$sql1))['studentName'];

      $teacherId = $_SESSION['teacherId'];
      $sql2 = "SELECT * FROM userdetails where teacherId=$teacherId";
      $query = mysqli_query($conn,$sql2);
      while ($row = mysqli_fetch_assoc($query)) {
          $teacherName = $row['teacherName'];
          $teacherClass = $row['teacherClass'];
          $teacherMobile = $row['teacherMobile'];
          $teacherCity = $row['teacherCity'];
      }

?>