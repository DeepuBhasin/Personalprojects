<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Page</title>
</head>

<body>

    <?php
    include "dbconfig.php";


    $ip = $_SERVER['REMOTE_ADDR'];
    $IPv4 = explode(".", $ip);

    echo "Your IP : $ip<br>";
    if (($IPv4[0] == "131" && $IPv4[1] == "125") || $IPv4[0] == "10") {

        echo "You are from Kean University.<br/>";
    } else {
        echo "You are NOT from Kean University.<br/>";
    }

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
        $sql = "SELECT * from `admin` where id=$user_id";
        $result = mysqli_query($conn, $sql);
    } else {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            header('location:index.php');
            exit;
        }

        $sql = "SELECT login FROM  `admin`  WHERE `login`='$username'";
        $login_result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($login_result) > 0) {
            $login_result_row = mysqli_fetch_array($login_result);
            $login = $login_result_row['login'];
            $sql = "SELECT * FROM  `admin`  WHERE `login`='$login' and `password`='$password'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 0) {
                echo "User $username is in the system, but wrong password was entered.";
                exit;
            }
        } else {
            echo "User $username is not in the database.";
            exit;
        }
    }

    $row = mysqli_fetch_array($result);

    $cookie_name = 'user_id';
    $cookie_value = $row['id'];
    $cookie_days = time() + 3600;
    $path = '/';
    setcookie($cookie_name, $cookie_value, $cookie_days, $path);

    $name = $row['name'];
    $dob = !empty($row['dob']) ? $row['dob'] : 'NULL';
    $address = $row['address'];
    $gender = $row['gender'];
    $age = !empty($row['dob']) ? round((time() - strtotime($row['dob'])) / (3600 * 24 * 365.25)) : 'NULL';
    $join_date = $row['join_date'];
    mysqli_close($conn);

    ?>

    <a href="logout.php">Logout</a><br />
    Welcome user : <?= $name; ?><br />
    dob : <?= $dob; ?><br />
    Address : <?= $address; ?><br />
    Gender : <?= $gender; ?><br />
    Age : <?= $age; ?><br />
    Join date : <?= $join_date; ?><br /><br />
    <a href='add_course.php'>Add a Course</a><br />
    Search course (id or name)
    <form action="search_course.php" method="GET">
        <input type="text" name="search_course" placeholder="Enter course id or name">
        <input type='submit' value='Search'>
    </form>

</body>

</html>