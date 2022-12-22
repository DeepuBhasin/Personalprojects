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
                <a class="navbar-brand" href="#">SMS Service By Henrry Goels</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php
        // dc52774e
        // IcyO5cj7uM9auaEh
        if (isset($_POST['send'])) {
            $from = $_POST['from'];
            $api_key = $_POST['api_key'];
            $api_secret = $_POST['api_secret'];
            $message = $_POST['message'];

            if (
                empty($from)
                || empty($api_key)
                || empty($api_secret)
                || empty($message)
                || empty($_FILES['text_file']['name'])
            ) { ?>
                <div class="col-md-8 col-lg-offset-2">
                    <div class="alert alert-danger msg">
                        Please Fill Out All Mandontary Fields.
                        <script type="text/javascript">
                            setTimeout(function() {
                                $('.msg').hide();
                            }, 3000);
                        </script>
                    </div>
                </div>
            <?php
            } else {
                $file = fopen($_FILES['text_file']['tmp_name'], "r");
                $z = 0;
                while (!feof($file)) {
                    $number[$z] = (float) fgets($file);
                    ++$z;
                }
                fclose($file);
                $response = [];
                foreach ($number as $value) {
                    $url = 'https://rest.nexmo.com/sms/json?' . http_build_query([
                        'api_key' => $api_key,
                        'api_secret' => $api_secret,
                        'to' => "$value",
                        'from' => $from,
                        'text' => $message
                    ]);
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($ch);
                    $response = json_decode($response, true);

                    if (isset($response['messages'])) {
                        $status = 'Sent Successfully';
                    } else {
                        $status = 'Faild';
                    }

                    $executeStatus = true;
                    array_push($response, [
                        'number' => $value,
                        'status' => $status
                    ]);
                }
            }
        }

        if (isset($executeStatus)) :
            ?>
            <div class="row">
                <div class="col-md-8 col-lg-offset-2">
                    <div class="alert alert-success msg">
                        Program Execute Successfully
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="table-responsive col-md-8 col-lg-offset-2" style="background-color: #9AE2CD;">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Phone Number</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $x = 0;
                            foreach ($response as $data) :
                                if (isset($data['number']) and !empty($data['number'])) :
                            ?>
                                    <tr>
                                        <td><?= ++$x ?></td>
                                        <td><?= $data['number']; ?></td>
                                        <td><?= $data['status']; ?></td>
                                    </tr>
                            <?php
                                endif;
                            endforeach;

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br><br><br><br>
        <?php endif; ?>

        <style>
            .whiteColor {
                color: #fff;
            }
        </style>
        <div class="col-md-8 col-md-offset-2">
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="mobile" class="control-label whiteColor">Upload Text File *</label>
                    <input type="file" id="mobile" class="form-control" name="text_file" placeholder="" required="" accept=".txt">
                </div>
                <div class="form-group">
                    <label for="from" class="control-label whiteColor">From *</label>
                    <input type="text" name="from" id="name" required class="form-control" placeholder="Enter From">
                </div>
                <div class="form-group">
                    <label for="api_key" class="control-label  whiteColor">Api Key *</label>
                    <input type="text" name="api_key" id="api_key" required class="form-control" placeholder="Enter Api Key">
                </div>
                <div class="form-group">
                    <label for="api_secret" class="control-label  whiteColor">Api Secret *</label>
                    <input type="text" name="api_secret" id="api_secret" required class="form-control" placeholder="Enter Api Secret">
                </div>
                <div class="form-group">
                    <label for="message" class="control-label whiteColor">Message *</label>
                    <textarea rows="5" id="message" class="form-control" id="message" name="message" maxlength="700" placeholder="Please Enter Message *" required=""></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" name="send" class="btn btn-success" name="submit">SEND</button>
                    <button type="reset" class="btn btn-primary">CLEAR</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>