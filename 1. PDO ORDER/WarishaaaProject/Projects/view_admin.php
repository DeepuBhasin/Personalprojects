<?php
include_once('dbconfig.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Admin Page</title>
</head>

<body>
    <table border="1">
        <thead>
            <th>Id</th>
            <th>Login</th>
            <th>Password</th>
            <th>Name</th>
            <th>DOB</th>
            <th>Join Date</th>
            <th>Gender</th>
            <th>Address</th>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM `admin`";
            $fetch = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($fetch)) {
            ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['login']; ?></td>
                    <td><?= $row['password']; ?></td>
                    <td><?= $row['name']; ?></td>
                    <?php
                    $diff_date = strtotime($row['join_date']) - strtotime($row['dob']);
                    if ($diff_date > 0) :
                    ?>
                        <td>
                            <font color='<?= empty($row['dob']) ? 'red' : 'blue'; ?>'><?= !empty($row['dob']) ? $row['dob'] : 'NULL' ?></font>
                        </td>
                        <td>
                            <font color=' blue'><?= $row['join_date']; ?></font>
                        </td>
                    <?php else : ?>
                        <td>
                            <font color='red'><?= $row['dob']; ?></font>
                        </td>
                        <td>
                            <font color='red'><?= $row['join_date']; ?></font>
                        </td>
                    <?php endif; ?>
                    <td><?= $row['gender']; ?></td>
                    <td><?= $row['address']; ?></td>
                </tr>
            <?php }
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</body>

</html>