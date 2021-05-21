<?php
session_start();
if(!isset($_SESSION['user_name']))
{
	header("location:index.php");
}
include_once('database.php');
if(isset($_POST['submit']))
{
  
  
    $full_name=stripcslashes(htmlspecialchars(trim($_POST['full_name'])));
    $destination_number=stripcslashes(htmlspecialchars(trim($_POST['destination_number'])));
    $email_id=strtolower(stripcslashes(htmlspecialchars(trim($_POST['email_id']))));
    $user_limit=stripcslashes(htmlspecialchars(trim($_POST['user_limit'])));
    $status=$_POST['status'];
    $user_id=$_POST['user_id'];

  if(!empty($full_name) && !empty($destination_number) && !empty($email_id) && !empty($user_limit))
  {
    try{
    
        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $DBH->beginTransaction();
        
        $stmt1=$DBH->prepare("SELECT * FROM didww_user WHERE user_id=:user_id");
        $stmt1->execute(['user_id'=>$user_id]); 
        $data=$stmt1->fetch(PDO::FETCH_OBJ);

        if($full_name==$data->full_name &&  $destination_number==$data->user_number && $email_id==$data->email_id && $user_limit<=$data->user_limit &&  $status==$data->status)
          {
              header("location:view_users.php?message=not_update");
              // echo "data not update";
          } 
          else
          {
            if($user_limit<=$data->user_limit )
            {
              header("location:view_users.php?message=limit_error");
              // echo "Data cannot update cz you are setting less Limit then actuall";
            }
            else
             {
                  // binding Parameters and provide name to parameters 
                $stmt = $DBH->prepare("UPDATE didww_user set full_name=:full_name,email_id=:email_id,user_number=:destination_number,user_limit=:user_limit,status=:status,limit_status=:limit_status WHERE user_id=:user_id");
                  //Assigning Values to parameters  
                  $stmt->execute(['full_name'=>$full_name,'email_id'=>$email_id,'destination_number'=>$destination_number,'user_limit'=>$user_limit,'status'=>$status,'limit_status'=>0,'user_id'=>$user_id]);

                 $DBH->commit();

                 header("location:view_users.php?message=success");
             } 
          }
        }
        catch(PDOException $e)
        {
          $DBH->rollback();
          header("location:view_users.php?message=fail");
          echo "Error: " . $e->getMessage();
        }
  }
  else
  { 
    header("location:view_users.php?message=fail");
  } 
}  
?>