<?php
 require '__database.php';

try {

	$teacherId=$_POST['teacherId'];

    $sql = "SELECT * FROM userdetails where teacherId=$teacherId";

    $result = @mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {


            $output = '<table id="tableId" class="table table-responsive">
                    <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Mobile Number</th>
                        <th>City</th>
                    </tr>
                    </thead>
                    <tbody>';

            while ($row = mysqli_fetch_assoc($result)) {

                $output .= "<tr><td>{$row['teacherName']}</td><td>{$row['teacherClass']}</td><td>{$row['teacherMobile']}</td><td>{$row['teacherCity']}</td></tr>";
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            // echo json_encode("No Record Found");
        }
    } else {
        throw new Exception(mysqli_error($con));
    }
} catch (Exception $e) {
    echo "Error : " . $e->getMessage();
}