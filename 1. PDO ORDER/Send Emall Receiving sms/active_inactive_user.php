<?php

if(isset($_GET['destination_number']) && isset($_GET['status']) && isset($_GET['api_code']))
{
  
  $destination_number=$_GET['destination_number'];
  $status=$_GET['status'];
  $api_code=$_GET['api_code'];

    if(!empty($destination_number) && !empty($api_code) && ($status==1 ||$status==0))
      {
       
       $destination_number=stripcslashes(htmlspecialchars(trim(urldecode($destination_number))));
       $status=stripcslashes(htmlspecialchars(trim(urldecode($status))));
       $api_code=stripcslashes(htmlspecialchars(trim(urldecode($api_code))));

       if($api_code=='testing_123_azbx_ythg')
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
                echo "Error : 400 Bad Request. Message : No Record Found.";
              }
              else
              {
                  // binding Parameters and provide name to parameters 
                  $stmt1 = $DBH->prepare("UPDATE didww_user set status=:status where user_number=:destination_number"); // 
                    
                    //Assigning Values to parameters  
                    $stmt1->execute(['status'=>$status,'destination_number'=>$destination_number]);

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