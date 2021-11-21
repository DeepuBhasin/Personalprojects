<?php
if (!isset($_COOKIE['user_id'])) {
    echo "please login first!";
    exit;
}
include_once('dbconfig.php');
if (isset($_GET['search_course'])) {
    $search_course = $_GET['search_course'];

    if ($search_course == '*') {
        $sql = "SELECT c.course_id,c.course_name,c.term,c.enrollment,f.names,r.room_info,r.size,a.name FROM course as c INNER JOIN faculty as f ON f.id=c.fid INNER JOIN room as r ON r.id=c.rid INNER JOIN admin as a ON a.id=c.added_by";
    } else {
        $sql = "SELECT c.course_id,c.course_name,c.term,c.enrollment,f.names,r.room_info,r.size,a.name FROM course as c INNER JOIN faculty as f ON f.id=c.fid INNER JOIN room as r ON r.id=c.rid INNER JOIN admin as a ON a.id=c.added_by where c.course_id like '%$search_course%' or c.course_name like '%$search_course%'";
    }


    $check = mysqli_query($conn, $sql);
    if (mysqli_num_rows($check) > 0) {
        echo "The following course ID and name were matched the search keyword <b>$search_course</b>.";
?>
        <table border="1">
            <thead>
                <th>Course ID</th>
                <th>Course Name</th>
                <th>Faculty Name</th>
                <th>Term</th>
                <th>Enrollment </th>
                <th>Building Room</th>
                <th>Size</th>
                <th>Added by Admin</th>
            </thead>
            <tbody>
                <?php
                $enrollment = 0;
                while ($row = mysqli_fetch_array($check)) {

                    $enrollment = $enrollment + $row['enrollment'];

                    $test = $row['size'] - $row['enrollment'];



                ?>
                    <tr>
                        <td><?= $row['course_id']; ?></td>
                        <td><?= $row['course_name']; ?></td>
                        <td><?= $row['names']; ?></td>
                        <td><?= $row['term']; ?></td>
                        <td>
                            <?php if ($test < 3) { ?>
                                <font color="red"><?= $row['enrollment']; ?></font>
                            <?php } else { ?>
                                <?= $row['enrollment']; ?>
                        </td>
                    <?php } ?>
                    <td><?= $row['room_info']; ?></td>
                    <td><?= $row['size']; ?></td>
                    <td><?= $row['name']; ?></td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>


<?php
        echo "Total enrollment: $enrollment";
    } else {
        echo "No course ID and name matched search keyword : <b>$search_course</b>";
    }
}
