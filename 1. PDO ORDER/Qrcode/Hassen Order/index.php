
<!DOCTYPE html>
<html>
<head>
    <title>SMS Service By Henrry Goels</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#0083C4;">
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">SMS Service By Henrry Goels</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li><a href="https://www.fiverr.com/henrrygoels?up_rollout=true">Fiverr Profile</a></li>
                
            </ul>
           
        </div><!-- /.navbar-collapse -->
    </div>
</nav>
<div class="container">

<?php    

   if (isset($_REQUEST['first_name']) && isset($_REQUEST['last_name']) && isset($_REQUEST['occupation'])) { 
        $data=$_REQUEST['first_name'].$_REQUEST['last_name'].$_REQUEST['occupation'];

        session_start();
        $_SESSION['name']=$data;


         //set it to writable location, a place for temp generated PNG files
        $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
        
        //html PNG location prefix
        $PNG_WEB_DIR = 'temp/';

        include "qrlib.php";    
        
        //ofcourse we need rights to create temp dir
        if (!file_exists($PNG_TEMP_DIR))
            mkdir($PNG_TEMP_DIR);
        
        
        $filename = $PNG_TEMP_DIR.'test.png';
        $level='H';
        
        //processing form input
        //remember to sanitize user input in real-life solution !!!
        $errorCorrectionLevel = 'L';
        if (isset($level) && in_array($level, array('L','M','Q','H')))
            $errorCorrectionLevel = $level;    

        $matrixPointSize = 6;
        if (isset($_REQUEST['size']))
            $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);
    
        //it's very important!
        if (trim($data) == '')
            die('data cannot be empty! <a href="?">back</a>');
            
        // user data
        $test = $PNG_TEMP_DIR.'test.png';

        QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 10); 

        $filename = $PNG_TEMP_DIR.'test'.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        
        QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 10);    
    			
        ?>
            <div class="col-md-6">
                <div class="row">
                    <style type="text/css">
                    .centered {
                          position: absolute;
                          top: 10%;
                          left: 50%;
                          transform: translate(-50%, -50%);
                        }
                    </style>
                    <div style="position: relative;text-align: center;">
                        <!-- <img src="<?= $PNG_WEB_DIR.basename($filename)?>" />      -->

                        <img src="imagesCode.php" alt="">
                          <!-- <p class="centered"><?= $data?></p> -->
                    </div>
                </div>
                    
              </div>    
   	<?php
   		 }else { ?>
            <div class="col-md-6">
                <div class="row">
                </div>
            </div>

    <?php     }	 
    ?>
        <div class="col-md-6">
        <div class="row">
            <form action="index.php" method="post">
             <div class="row">
                 <div class="form-group col-md-6">
                    <lable>First Name </lable>
                    <input name="first_name" value="<?= (isset($_REQUEST['first_name'])?htmlspecialchars($_REQUEST['first_name']):'')?>" class="form-control" required="" placeholder="Please Enter Data"/>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">  
                    <lable>Last Name</lable> 
                    <input name="last_name" value="<?= (isset($_REQUEST['last_name'])?htmlspecialchars($_REQUEST['last_name']):'')?>" class="form-control" required="" placeholder="Please Enter Data"/>
                </div> 
            </div>
            <div class="row">
                <div class="form-group col-md-6">  
                    <lable>Occupation</lable> 
                    <input name="occupation" value="<?= (isset($_REQUEST['occupation'])?htmlspecialchars($_REQUEST['occupation']):'')?>" class="form-control" required="" placeholder="Please Enter Data"/>
                    
                </div> 
            </div>       
            <input type="submit" class="btn btn-md btn-success" value="GENERATE">
        </form>
        </div>
        
    
</div>
</body>
</html>