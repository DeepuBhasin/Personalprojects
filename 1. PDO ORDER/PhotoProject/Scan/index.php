<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>webcam-js</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='style/webcam-demo.css'>
     <link href="font/css/all.css" rel="stylesheet"> <!--load all styles -->
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    
    <script src="dist/webcam-easy.min.js"></script> 
</head>
<body>


    <main id="webcam-app">
        
        <div class="form-control webcam-start" id="webcam-control">
                <button id="cameraFlip" class="btn d-none"></button> 
                <a href="../index.php" class="btn-close btn-close-white" aria-label="Close"></a>

        </div>

        <div class="md-modal md-effect-12">
            <div id="app-panel" class="app-panel md-content row p-0 m-0">     
                <div id="webcam-container" class="webcam-container col-12 d-none p-0 m-0">
                    <video id="webcam" autoplay playsinline width="640" height="480"></video>
                    <canvas id="canvas" class="d-none"></canvas>
                    <div class="flash"></div>
                    <audio id="snapSound" src="audio/snap.wav" preload = "auto"></audio>
                </div>
                <div id="cameraControls" class="cameraControls">
                  
                    <a href="#" id="take-photo" title="Take Photo"><i class="material-icons">camera_alt</i></a>
                    <a href="#" id="download-photo" download="selfie.jpeg" target="_blank" title="Save Photo" class="d-none"><i class="material-icons">file_download</i></a>
                    <a href="#" id="resume-camera"  title="Resume Camera" class="d-none"><i class="material-icons">camera_front</i></a>
                    <form runat="server"  onsubmit="ShowLoading()" action="send.php" method="post">
                    <input type="hidden" name="imageName" id="hiddenId" value="">
                    <button  id="hiddenButton" class="d-none scanBuuton" name="submitImage">USE IMAGE</button>

                    </form>
                    
                    <style> 
input[type=button], input[type=submit], input[type=reset],.scanBuuton {
  background-color: #000000;
  border: none;
  color: white;
  padding: 16px 32px;
  text-decoration: none;
  margin: 9px 9px;
  cursor: pointer;
  font-family:Fantasy;
  font-size: 20px;
}
</style>
                </div>
            </div>        
        </div>
        <div class="md-overlay"></div>
    </main>

    <script src='js/app.js'></script>
    
   

<script type="text/javascript">
    function ShowLoading(e) {
    document.getElementById('hiddenButton').textContent="" ;
    $('#hiddenButton').append('<i class="fas fa-spinner fa-spin"></i> Loading');
}

</script>

</body>
</html>