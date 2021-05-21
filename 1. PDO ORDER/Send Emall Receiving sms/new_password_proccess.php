<?php
                       
if(isset($_POST['submit']))
{
  
 	$new_password=stripcslashes(htmlspecialchars(trim($_POST['new_password'])));
  $code=$_POST['code'];
  
  if(!empty($new_password))
  {

    try{
        include_once('database.php'); 
        
        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
        $stmt = $DBH->prepare("SELECT * FROM login_user where code=:code and status=:status"); // 
        
        //Assigning Values to parameters  
        $stmt->execute(['code'=>$code,'status'=>0]);
        
        if($stmt->rowCount()>0)
        {
           header("location:index.php?message=already_fail");
           exit;
        }

        $DBH->beginTransaction();
        $stmt = $DBH->prepare("UPDATE login_user set password=:new_password,status=:status where code=:code"); // 
        
        $stmt->execute(['new_password'=>$new_password,'status'=>0,'code'=>$code]);
            $DBH->commit();  
        	header("location:index.php?message=success");	
        }  
    
    catch(PDOException $e)
        {
          $DBH->rollback();
          echo "Error: " . $e->getMessage();
        }
  }
  else
  { 
    header("location:index.php?message=empty_fail"); 
  } 

}
else
{
  header("location:index.php?message=access_fail");  
}  
?>