<!DOCTYPE html>
<html>

<head>
    <title>Cloud vision</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style type="text/css">
    body,
    html {
        height: 100%;

    }

    .bg {
        background-image: url('images/bg.jpg');
        background-repeat: no-repeat;
        height: 100%;
        background-position: center;
        background-size: cover;

    }
    </style>
</head>

<body class="bg">
    <div class="container">
        <br /><br /><br />
        <div class="row">
            <div class="col-md-6 offset-md-3"
                style="margin:auto;background:white;padding:20px;box-shadow:10px 10px 5px #880">
                <div class="panel-heading">
                    <h2>Google Cloud Vision Api</h2>
                    <p style="font-style:italic;">Coolest Image Processing Engine on Earth </p>
                </div>
                <hr>
                <form action="check.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="image" id="" accept="image/*" class="form-control">
                    <br>
                    <button type="submit" style="border-radius:0px;"
                        class="btn btn-block btn-outline-success">Analysis</button>
                </form>

            </div>
        </div>
    </div>
</body>

</html>