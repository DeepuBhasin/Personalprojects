<?php

if(isset($_GET['full_name']) && isset($_GET['destination_number']) && isset($_GET['email_id']) && isset($_GET['api_code']))
{
  $full_name=$_GET['full_name'];
  $destination_number=$_GET['destination_number'];
  $email_id=$_GET['email_id'];
  $user_limit=$_GET['user_limit'];
  $api_code=$_GET['api_code'];

    if(!empty($full_name) && !empty($destination_number) && !empty($email_id) && !empty($api_code))
      {
        
        $full_name=stripcslashes(htmlspecialchars(trim(urldecode($full_name))));
        $destination_number=stripcslashes(htmlspecialchars(trim(urldecode($destination_number))));
        $email_id=strtolower(stripcslashes(htmlspecialchars(trim(urldecode($email_id)))));
        $user_limit=stripcslashes(htmlspecialchars(trim(urldecode($user_limit))));

       if($api_code=='testing_123_abc_xyz')
       { 
          include_once('database.php');
          
          try{
          
              $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $DBH->beginTransaction();

               $stmt = $DBH->prepare("SELECT * FROM didww_user where email_id=:email_id and user_number=:destination_number"); // 
              
              //Assigning Values to parameters  
              $stmt->execute(['email_id'=>$email_id,'destination_number'=>$destination_number]);

              if($stmt->rowCount()>0)
              {
                echo "Error : 400 Bad Request. Message : User Already Exist.";
              }
              else
              {
                  // binding Parameters and provide name to parameters 
                  $stmt = $DBH->prepare("INSERT into didww_user(full_name,email_id,user_number,user_limit,status,created_dt) Values(:full_name,:email_id,:destination_number,:user_limit,:status,:created_dt)"); // 
                    
                    //Assigning Values to parameters  
                    $stmt->execute(['full_name'=>$full_name,'email_id'=>$email_id,'destination_number'=>$destination_number,'user_limit'=>$user_limit,'status'=>1,'created_dt'=>$get_time]);

                   $DBH->commit();
                  
                  echo "Success : 200 Success. Message : User Created Successfully.";
              }  
          }
          catch(PDOException $e)
              {
                $DBH->rollback();
                echo "Error: " . $e->getMessage();
              }
        }
        else
        { 
            echo "Error : 400 Bad Request. Message : Security Code not correct.";
        }

      }
     else
     {
        echo "Error : 400 Bad Request. Message : Parameters are Empty.";
     }
   }
 else
 {
    echo "Error : 400 Bad Request. Message : access Denied.";
 }     
?>