<!DOCTYPE html>
<html lang="en">

<head>
    <title>Course Add </title>
</head>

<body>

    <?php
    if (!isset($_COOKIE['user_id'])) {
        echo "please login first!";
        exit;
    }
    include_once('dbconfig.php');

    $error = [];
    if (empty(trim($_POST['course_id']))) {
        array_push($error, 'Course Id should not empty');
    }
    if (empty(trim($_POST['course_name']))) {
        array_push($error, 'Course should not empty');
    }
    if (empty($_POST['term'])) {
        array_push($error, 'Term should not empty');
    }
    if (empty(trim($_POST['enrollment']))) {
        array_push($error, 'Enrollment should not empty');
    }
    if (empty($_POST['fid'])) {
        array_push($error, 'Faculty should not empty');
    }
    if (empty($_POST['rid'])) {
        array_push($error, 'Room should not empty');
    }

    if (isset($error) && !empty($error)) {
        echo "<h2>Error !!</h2>
    <ol>";
        foreach ($error as $key => $value) {
            echo "<li> $value</li>";
        }
        echo "</ol>";
    }

    $course_id = $_POST['course_id'];
    $sql = "SELECT * FROM course where course_id=$course_id";
    $check = mysqli_query($conn, $sql);
    if (mysqli_num_rows($check) === 0) {
        $course_name = $_POST['course_name'];
        $term = implode(',', $_POST['term']);
        $enrollment = $_POST['enrollment'];
        $fid = $_POST['fid'];
        $rid = $_POST['rid'];
        $added_by = $_COOKIE['user_id'];


        $sql = "INSERT into course values(null,'$course_id','$course_name','$term','$enrollment',$fid,$rid,$added_by);";
        $check = mysqli_query($conn, $sql);
        if ($check) {
            echo "course $course_id , $course_name has been added successfully";
        } else {
            echo "Database Error. " . mysqli_error($conn);
        }
    } else {

        echo '<a href="logout.php">logout</a>
    <br />Cannot have the same course id $course_id';
    }
    ?>
</body>

</html>