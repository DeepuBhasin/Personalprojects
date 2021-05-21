<?php
    if((!empty($_POST['phoneNumbers'])) && (!empty($_POST['messageBody']))){
        $params = array(
            'phoneNumbers' => $_POST['phoneNumbers'],
            'messageBody' => $_POST['messageBody'],
        );

        $url = 'http://localhost/voyonson/sendSMS.php';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        $response = curl_exec($ch);
        curl_close($ch);
        //echo "<pre>";
        //print_r($response);
        //exit();
        header('Refresh:0');
    }
?>
<!DOCTYPE html>
<html>
<head>
     <link rel=icon type="image/png" href="https://web.njit.edu/~gb229/index_files/favicon.png">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>
<div class='container-fluid mt20'>
    <div class="row justify-content-center">
        <div class='col-sm-offset-4 col-sm-4 border rounded bg-light '>
            <form action="" method='post' id='frmSendSMS'>
                <h3 class='text-center mt15'>Send SMS</h3>
                <div class='alert alert-danger' id='msgBox' style='display: none;'></div>
                <div class='form-group'>
                    <label>Numbers: </label>
                    <textarea type="text" class='form-control' id="phoneNumbers"  name="phoneNumbers" placeholder="Comma separated"></textarea>
                </div>
                <div class='form-group'>
                    <label>Body: </label>
                    <textarea type="text" class='form-control' id="messageBody"  name="messageBody" placeholder="" rows='5'></textarea>
                </div>
                <div class='form-group text-center'>
                    <input class='btn btn-outline-secondary' type="button" id='btnSendSMS' value="Send SMS" >
                    <input class='btn btn-outline-secondary' type="button" id='btnPleaseWait' value="Please wait.." disabled="" style='display: none;'>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#btnSendSMS").click(function(){
            $('#msgBox').hide();
            var phoneNumbers = $('#phoneNumbers').val();
            if(!phoneNumbers || phoneNumbers.trim() == ''){
                $('#msgBox').html('Please enter phone numbers.').slideDown();
                return false;
            }
            var messageBody = $('#messageBody').val();
            if(!messageBody || messageBody.trim() == ''){
                $('#msgBox').html('Please enter message body.').slideDown();
                return false;
            }
            $('#btnSendSMS').hide();
            $('#btnPleaseWait').show();
            $('#frmSendSMS').submit();
        });
    });
</script>
</body>
</html>