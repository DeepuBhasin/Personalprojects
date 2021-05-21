<?php
include_once('database.php');
 if(isset($_POST['id']))
 {
   $id = $_POST["id"];
  try {

  	$data=$conn->prepare("SELECT row_points From item WHERE item_id=$id");

  	$data->execute();

  	$row=$data->fetch(PDO::FETCH_OBJ);

  	$user_point=$conn->prepare("SELECT user_point from user where user_id=1");

  	$user_point->execute();

  	$user_row=$user_point->fetch(PDO::FETCH_OBJ);

  	$new_data=$row->row_points+$user_row->user_point;

  	$sql1 = "UPDATE user SET user_point=$new_data WHERE user_id=1";

    // Prepare statement
    $stmt1 = $conn->prepare($sql1);

    // execute the query
    $stmt1->execute();

    $sql = "UPDATE item SET item_code='5' WHERE item_id=$id";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the UPDATE succeeded
    
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
} 
?>

