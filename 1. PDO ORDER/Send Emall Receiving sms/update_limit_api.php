<?php

if(isset($_GET['destination_number']) && isset($_GET['user_limit']) && isset($_GET['api_code']))
{
  
  $destination_number=$_GET['destination_number'];
  $user_limit=$_GET['user_limit'];
  $api_code=$_GET['api_code'];

    if(!empty($destination_number) && !empty($api_code) && !empty($user_limit))
      {
       
       $destination_number=stripcslashes(htmlspecialchars(trim(urldecode($destination_number))));
       $user_limit=stripcslashes(htmlspecialchars(trim(urldecode($user_limit))));
       $api_code=stripcslashes(htmlspecialchars(trim(urldecode($api_code))));

       if($api_code=='testing_123_azbx_limit')
       { 
          include_once('database.php');
          
          try{
          
              $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $DBH->beginTransaction();

               $stmt = $DBH->prepare("SELECT * FROM didww_user where user_number=:destination_number"); // 
              
              //Assigning Values to parameters  
              $stmt->execute(['destination_number'=>$destination_number]);

              if($stmt->rowCount()<0)
              {
                echo "Error : 400 Bad Request. Message : No Record found.";
              }
              else
              {
                $row=$stmt->fetch(PDO::FETCH_OBJ);
                $new_user_limit=$row->user_limit + $user_limit;
                
                  // binding Parameters and provide name to parameters 
                  $stmt1 = $DBH->prepare("UPDATE didww_user set user_limit=:user_limit,limit_status=:limit_status where user_number=:destination_number"); // 
                    
                    //Assigning Values to parameters  
                    $stmt1->execute(['user_limit'=>$new_user_limit,'limit_status'=>0,'destination_number'=>$destination_number]);

                   $DBH->commit();
                  
                  echo "Success : 200 Success. Message : User Updated Successfully.";
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