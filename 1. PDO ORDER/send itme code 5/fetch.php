<?php
//fetch.php
include_once('database.php');
$output = '';
$query=$conn->query("SELECT * FROM item ORDER BY item_id DESC");
// $result = mysqli_query($connect, $query);
$output = '
<br />
<h3 align="center">Item Data</h3>
<table class="table table-bordered table-striped">
 <tr >
 <th><input type="checkbox" name="" id="select_all" onchange="select_all(this);"></th>
  <th width="30%">Item Name</th>
  <th width="10%">Item Code</th>
  <th width="40%">Description</th>
  <th width="10%">Price</th>
  <th width="20%">Date</th>
  <th width="20%">Points</th>
 </tr>
';
$x=1;
while($row = $query->fetch(PDO::FETCH_OBJ))
{
 $output .= '
 <tr id="check_column'.$x.'">
  <td><input type="checkbox" onchange="radio_check(this);" id='.$x.' class="my_check_box'.$x.'" name="check_box" value='.$row->item_id.'></td>		
  <td>'.$row->item_name.'</td>
  <td>'.$row->item_code.'</td>
  <td>'.$row->item_description.'</td>
  <td>'.$row->item_price.'</td>
  <td>'.date("d-m-Y",strtotime($row->item_date)).'</td>
  <td>'.$row->row_points.'</td>
 </tr>
 ';
 ++$x;
}
$output .= '</table>
<button class="btn btn-success" type="button" id="send_button" onclick="update_data(this);" disabled="disabled">Update</button>
';
echo $output;
?>
