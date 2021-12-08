<?php
include_once('conn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <title>Show All Tags</title>
</head>

<body>
    <div class="container">
        <h2>Show All Tags</h2>
        <button type="button" class="btn btn-success" onclick="window.print();">Print</button>

        <br>
        <div class="row">

            <table class="table" id="example">
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Code</th>
                        <th>Creation Date</th>
                        <th>Expiration Date</th>
                        <th>Period</th>
                        <th>Avial</th>
                        <th>Image</th>
                    </tr>
                </thead>

                <?php
               $sql = "SELECT * FROM coupons order by id DESC;";
                $row = mysqli_query($conn, $sql);
                $c = 1;
                while ($ab = mysqli_fetch_array($row)) :
                ?>
                    <tr>
                        <td><?= $c++; ?></td>
                        <td><?= $ab['code']; ?></td>
                        <td><?= date('Y-m-d', strtotime($ab['code_date_create'])); ?></td>
                        <td><?= date('Y-m-d', strtotime($ab['codeDate'])); ?></td>
                        <td><?= $ab['period']; ?></td>
                        <td><?= $ab['avail']; ?></td>
                        <td>
                            <a href="https://chart.googleapis.com/chart?cht=qr&chs=500x500&chl=<?= $ab['code'] ?>" target="_blank" download> <img src="https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=<?= $ab['code'] ?>" alt="">
                            </a>
                            </ </td>
                    </tr>
                <?php endwhile; ?>
                <tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
        $('#example').DataTable( {
            "pagingType": "full_numbers"
        } );
    } );
    </script>
    
    
</body>

</html>