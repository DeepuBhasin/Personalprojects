<?php
if (!isset($_COOKIE['user_id'])) {
    echo "please login first!";
    exit;
}
include_once('dbconfig.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Course</title>
</head>

<body>
    <a href='logout.php'>logout</a><br>
    <font size=4><b>Add a course</b></font>
    <form action="insert_course.php" method="POST">
        Course ID: <input type="text" name="course_id" size=5 required="required"> (ex: CPS1231)<br>
        Course Name: <input type="text" name="course_name" required="required"><br>
        Term:
        <input type='checkbox' name='term[]' value='Spring'>Spring
        &nbsp;<input type='checkbox' name='term[]' value='Summer'>Summer
        &nbsp;<input type='checkbox' name='term[]' value='Fall'>Fall
        <br>
        Enrollment: <input type="number" name="enrollment" size=3 required="required">(# of registered students)
        <br>Select a faculty: <select name='fid' required="">
            <option value=''></option>
            <?php
            $sql = "SELECT * FROM faculty";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <option value="<?= $row['id'] ?>"><?= $row['names']; ?></option>
            <?php
            }
            ?>
        </select>
        <br>Room: <select name='rid' required="">
            <option value=''></option>
            <?php
            $sql = "SELECT * FROM room";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <option value="<?= $row['id'] ?>"><?= $row['room_info']; ?></option>
            <?php
            }
            ?>
        </select>
        <input type='submit' name="add_course" value='Submit'>

    </form>

</body>

</html>