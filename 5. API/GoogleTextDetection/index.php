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
    <script src="dist/webcam-easy.min.js"></script> 
</head>
<!-- <body>
        <script type="text/javascript">
    function ShowLoading(e) {
        var div = document.createElement('div');
        var img = document.createElement('img');
        img.src = 'https://i.gifer.com/YCZH.gif';
        div.style.cssText = 'position: fixed; top: 5%; z-index: 5000';
        div.appendChild(img);
        document.body.appendChild(div);
        return true;
        // These 2 lines cancel form submission, so only use if needed.
        //window.event.cancelBubble = true;
        //e.stopPropagation();
    }
</script> -->
    <main id="webcam-app">
        <div class="form-control webcam-start" id="webcam-control">
                <label class="form-switch">
                <input type="checkbox" id="webcam-switch">
                <i></i> 
                <span id="webcam-caption">Click to Start Camera</span>
                </label>      
                <button id="cameraFlip" class="btn d-none"></button>                  
        </div>
        
        <div id="errorMsg" class="col-12 col-md-6 alert-danger d-none">
            Fail to start camera, please allow permision to access camera. <br/>
            If you are browsing through social media built in browsers, you would need to open the page in Sarafi (iPhone)/ Chrome (Android)
            <button id="closeError" class="btn btn-primary ml-3">OK</button>
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
                    <a href="#" id="exit-app" title="Exit App" class="d-none"><i class="material-icons">exit_to_app</i></a>
                    <a href="#" id="take-photo" title="Take Photo"><i class="material-icons">camera_alt</i></a>
                    <a href="#" id="download-photo" download="selfie.png" target="_blank" title="Save Photo" class="d-none"><i class="material-icons">file_download</i></a>
                    <a href="#" id="resume-camera"  title="Resume Camera" class="d-none"><i class="material-icons">camera_front</i></a>
                    <form runat="server"  onsubmit="ShowLoading()" action="send.php" method="post">
                    <input type="hidden" name="imageName" id="hiddenId" value="">
                    <button  id="hiddenButton" class="d-none scanBuuton" name="submitImage">SCAN</button>

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