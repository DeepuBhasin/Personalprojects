<?php
include_once('database.php');

if(isset($_POST["item_name"]))
{
 $item_name = $_POST["item_name"];
 $item_code = $_POST["item_code"];
 $item_desc = $_POST["item_desc"];
 $item_price = $_POST["item_price"];
 $item_date = $_POST['item_date'];
 $query = '';
 $x=0;
 for($count = 0; $count<count($item_name); $count++)
 {
  $item_name_clean =  stripcslashes(htmlspecialchars(trim(($item_name[$count]))));
  $item_code_clean =  stripcslashes(htmlspecialchars(trim(($item_code[$count]))));
  $item_desc_clean =  stripcslashes(htmlspecialchars(trim(($item_desc[$count]))));
  $item_price_clean =  stripcslashes(htmlspecialchars(trim(($item_price[$count]))));
  $item_date_clean =  stripcslashes(htmlspecialchars(trim(($item_date[$count]))));
  if($item_name_clean != '' && $item_code_clean != '' && $item_desc_clean != '' && $item_price_clean != '' && $item_date_clean!='')
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // begin the transaction
    $conn->beginTransaction();
    // our SQL statements
    $conn->exec("INSERT INTO item (item_name, item_code, item_description,item_price,item_date)
    VALUES ('$item_name_clean', '$item_code_clean', '$item_desc_clean','$item_price_clean','$item_date_clean')");
   
   // commit the transaction
    $conn->commit();
    // echo "New records created successfully";
    $recored=++$x;

    }
catch(PDOException $e)
    {
    // roll back the transaction if something failed
    $conn->rollback();
    echo "Error: " . $e->getMessage();
    }
 }

if (isset($recored)) {
	echo "Number of recordes $recored added successfully";
	# code...
}
else
{
	echo "No Recorder Added";
}

}
?>