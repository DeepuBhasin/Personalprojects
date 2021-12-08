<?php
include_once('conn.php');
if (isset($_POST['save'])) {
    $period = mysqli_real_escape_string($conn, $_POST['period']);
    $create_date = mysqli_real_escape_string($conn, $_POST['create_date']);
    $expire_date = mysqli_real_escape_string($conn, $_POST['expire_date']);

    $sql = '';
    $count = count($_POST['code']);
    for ($z = 0; $z < $count; $z++) {
        $postCode = $_POST['code'][$z];
        $sql .= "INSERT into coupon values(null,'$postCode','$expire_date','$create_date','$period','1');";
    }

    $check = mysqli_multi_query($conn, $sql);
    if ($check) {
        $message = "Data Saved Successfully";
        $color = "success";
    } else {
        $message = "Database Error";
        $color = "danger";
    }
    header("location:coupon.php?color=$color&message=" . urlencode($message));
    exit;
}
if (!isset($_POST['total_coupon_numbers']) && $_POST['total_coupon_numbers'] <= 0) {
    header('location:coupon.php?color=danger&&message=' . urlencode('Please Enter a Valid Number'));
    exit;
}


$total_coupon_numbers = mysqli_real_escape_string($conn, $_POST['total_coupon_numbers']);

function coupon($l)
{
    $coupon = substr(str_shuffle(str_repeat('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', $l - 2)), 0, $l - 2);

    return $coupon;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Generate Code</title>
</head>

<body>
    <div class="container">
        <br>
        <div class="row">
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="mb-3">
                    <label for="total_coupon_numbers" class="form-label">
                        <h2>Generated Coupons</h2>
                    </label>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sr No.</th>
                                <th>Code</th>
                                <th>Image</th>
                            </tr>
                        </thead>

                        <?php
                        $c = 1;
                        for ($i = 0; $i < $total_coupon_numbers; $i++) :
                            $code = coupon(10);
                        ?>
                            <tr>
                                <td><?= $c++; ?></td>
                                <td>
                                    <?= $code; ?>
                                    <input type="hidden" name="code[]" value="<?= $code; ?>">
                                </td>
                                <td><img src="https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=<?= $code ?>" alt="">
                                </td>
                            </tr>
                        <?php endfor; ?>
                        <tbody>
                    </table>
                </div>
                <div class="mb-3">
                    <label for="period">Number of Days</label>
                    <input type="number" class="form-control" name="period" id="period" required="required" placeholder="Please Enter Number of Days " required="" min="1" />
                </div>
                <div class="form-group mb-3">
                    <label for="">Date Creation</label>
                    <input type="date" name="create_date" class="form-control" required="" />
                </div>

                <div class="form-group mb-3">
                    <label for="">Date Expiration</label>
                    <input type="date" name="expire_date" class="form-control" required="" />
                </div>
                <div class="mb-3">
                    <button type="submit" name="save" class="btn btn-success">Save</button>
                </div>
            </form>

        </div>
    </div>


</body>

</html>