<?php
include_once('dbconfig.php');
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];

    if ($keyword == '*') {
        $sql = "SELECT * FROM `admin`";
        $concat = '';
    } else {
        $sql = "SELECT * from `admin` where address like '%$keyword%'";
        $concat = "that the address contains search keyword <b>$keyword</b>.";
    }

    $check = mysqli_query($conn, $sql);
    if (mysqli_num_rows($check) > 0) {
        echo "There are " . mysqli_num_rows($check) . " in the database " . $concat;
?>
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
                while ($row = mysqli_fetch_array($check)) {
                ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['login']; ?></td>
                        <td><?= $row['password']; ?></td>
                        <td><?= $row['name']; ?></td>
                        <?php
                        $diff_date = strtotime($row['join_date']) - strtotime($row['dob']);
                        if ($diff_date > 0) {
                        ?>
                            <td>
                                <font color='<?= empty($row['dob']) ? 'red' : 'blue'; ?>'><?= !empty($row['dob']) ? $row['dob'] : 'NULL' ?></font>
                            </td>
                            <td>
                                <font color=' blue'><?= $row['join_date']; ?></font>
                            </td>
                        <?php } else { ?>
                            <td>
                                <font color='red'><?= $row['dob']; ?></font>
                            </td>
                            <td>
                                <font color='red'><?= $row['join_date']; ?></font>
                            </td>
                        <?php } ?>
                        <td><?= $row['gender']; ?></td>
                        <td><?= $row['address']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

<?php
    } else {
        echo "No records in the database for the keyword: <b>$keyword</b>";
    }
}
