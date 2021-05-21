<?php
 require '__database.php';

try {

    $classId=$_POST['classId'];
    $sectionId=$_POST['sectionId'];

    $sql1  = "SELECT class_limit from class_table where class_id=$classId";
    $class_limit = mysqli_fetch_assoc(mysqli_query($conn, $sql1))['class_limit'];

   $sql = "SELECT * FROM teacher_table where section_id=$sectionId and class_id=$classId and  status IS NULL";
    // exit;
    $result = @mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {


            $output = '<table id="myTableId" class="table table-responsive">
                    <thead class="table-dark">
                    <tr>
                        <th>Action</th>
                        <th>Sri. No</th>
                        <th>Teacher Name</th>
                    </tr>
                    </thead>
                    <tbody>';
            $x=0;            
            while ($row = mysqli_fetch_assoc($result)) {

                $output .= "<tr><td><input type='checkbox' onchange='checkboxfunction(this)' name='teacher_id[".$x."]' value='".$row['teacher_id']."' id='id_".$row['teacher_id']."'></td><td>".++$x."</td><td>{$row['teacher_name']}</td></tr>";
            }
            $output .= '</tbody></table>';
            
            echo json_encode(array('class_limit'=>$class_limit,'output'=>$output)); 

        } else {
            echo json_encode("No Record Found");
        }
    } else {
        throw new Exception(mysqli_error($con));
    }
} catch (Exception $e) {
    echo "Error : " . $e->getMessage();
}