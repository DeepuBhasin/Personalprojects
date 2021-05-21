<?php
include_once 'dbConfig.php';
{
       $query="DELETE FROM admin WHERE id='" . $_GET["id"] . "'";
        $result=dbConfig::run($query);
     
       
    if(!$result)
           {
            throw new Exception("Error in query", 1);
           }
             $data=array('status'=>'Success','msg'=>'','result'=> $result);
       }
     
mysqli_close($conn);
?>