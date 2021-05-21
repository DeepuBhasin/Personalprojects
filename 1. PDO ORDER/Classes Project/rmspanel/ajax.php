<?php $db= new mysqli('localhost','ishawebh_ishaweb','FOCA-~O8f!D9','ishawebh_rmspanel'); 
extract($_POST);
$user_id=$db->real_escape_string($id);
$status=$db->real_escape_string($status);
$sql=$db->query("UPDATE admin SET status='$status' WHERE id='$id'");
echo 1;

?>