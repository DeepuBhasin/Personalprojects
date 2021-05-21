<?php
 require '__database.php';

try {

	$classId=$_POST['classId'];

    $sql = "SELECT * FROM section_table where class_id=$classId";

    $result = @mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
                $output = '<option value="">Select Section </option>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $output .= '<option value="'.$row['section_id'].'">'.$row['section_name'].'</option>';
            }
            
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