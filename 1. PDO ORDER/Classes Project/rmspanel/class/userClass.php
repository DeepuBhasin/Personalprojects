<?php 
 require_once("dbConfig.php");
 
 class userClass extends dbConfig
 {
   public static $data;

   function __construct()
   {
     parent::__construct();
   }

 //================= Userexist //========================================================================

   public static function chkUserexist($emailidf)
   {
    try
    {
     $query="SELECT emailidf from admin WHERE emailidf='".$emailidf."'";
     $result=dbConfig::run($query);
     if(!result)
     {
      throw new Exception("Error In User Exit query", 1);
     }
     $count=mysqli_num_rows($result);
     if($count>0)
     {
        throw new Exception("User Already Exist", 1);
     }
     $data=array('status'=>'Success','msg'=>'','result'=>'');
     }
     catch(Exception $e)
     {
      $data=array('status'=>'error','msg'=>$e->getMessage());
     }
     finally
     {
      return $data;
     }

   } 
   //========================================================================

   public static function chkuser($emailidf,$password)
   {
    try 
    {
      $query="SELECT emailidf,password FROM admin WHERE emailidf='".$emailidf."' and password='".$password."'";

      $result=dbConfig::run($query);
      if(!result)
      {
        throw new Exception("Error In chkuser process", 1);
      }
      $count=mysqli_num_rows($result);
       
      if($count==0)
      {
        throw new Exception("Icorrect Username and Password", 1);
      }
      $data=array('status'=>'Success','msg'=>'','result'=>'');
   }

   catch(Exception $e)
   {
     $data=array('status'=>'error','msg'=>$e->getMessage());
   }
   finally
   {
    return $data;
   } 
 }

  //========================================================================

   public static function login($emailidf,$password)
   {
     try
     {
       $chklogin=self::chkuser($emailidf,$password);
        

       if($chklogin['status']=='error')
       {
          $data=$chklogin;
       }
       else
       {
        $query="SELECT * FROM admin WHERE emailidf='".$emailidf."' and password='".$password."'";
        $result=dbConfig::run($query);
        if(!$result)
           {
            throw new Exception("Error in query", 1);
           }
           $resultSet=mysqli_fetch_assoc($result);
            $_SESSION['login']=true;
            $_SESSION['id']= $resultSet['id'];
            $_SESSION['admintype']= $resultSet['admintype'];
           
           $data=array('status'=>'Success','msg'=>'','result'=>$resultSet);
       }

     }
     catch(Exception $e)
     {
      $data=array('status'=>'error', 'msg'=>$e->getMessage());
     }
     finally
     {

      return $data;
       
     }
   }
   
   
   //========================================================================

   
    //========================================================================
    //========================================================================
  public static function registeruser($date_of_registration)
  {
      try
  {
        $query="SELECT count(*) as newreg from registeruser WHERE date_of_registration='".$date_of_registration."'";  
          $result=dbConfig::run($query);
        if(!$result)
           {
            throw new Exception("Error in query", 1);
           }
   
           
           $data=array('status'=>'Success','msg'=>'','result'=>$result);
       }

     
     catch(Exception $e)
     {
      $data=array('status'=>'error', 'msg'=>$e->getMessage());
     }
     finally
     {

      return $data;
       
     }
  }
  
 
   //========================================================================
  
    public static function GetDatewiseMembers($curdate)
  {
      try
  {
        $query="select count(*) as num from userdirectory where approved='0'";  
          $result=dbConfig::run($query);
        if(!$result)
           {
            throw new Exception("Error in query", 1);
           }
           
           $data=array('status'=>'Success','msg'=>'','result'=>$result);
       }

     
     catch(Exception $e)
     {
      $data=array('status'=>'error', 'msg'=>$e->getMessage());
     }
     finally
     {
      return $data;
       
     }
  }
  
   //========================================================================
  
   public static function registeruser_all()
  {
      try
  {
        $query="SELECT * FROM userdirectory ";  
          $result=dbConfig::run($query);
        if(!$result)
           {
            throw new Exception("Error in query", 1);
           }
          $count=mysqli_num_rows($result);
          
           
           $data=array('status'=>'Success','msg'=>'','result'=>$count);
       }

     
     catch(Exception $e)
     {
      $data=array('status'=>'error', 'msg'=>$e->getMessage());
     }
     finally
     {

      return $data;
       
     }
  }
   public function get_session()
   {
      return $_SESSION['login'];
   }


   public function user_logout()
   {
      $_SESSION['login']=FALSE;
      session_destroy();
   }
   
 //========================================================================


  
  
  //==================================================function addstaff()/() function code starts here==================================================//

   public static function addstaff($fname,$lname,$emailidf,$emailids,$password,$admintype,$status)
   {
    try
     {
      $chkuser=self::chkUserexist($emailidf);
      if($chkuser['status']=='error')
      {
        $data=$chkuser;
      }
      else{
        $query = "INSERT INTO admin(fname,lname,emailidf,emailids,password,admintype,status)VALUES('$fname','$lname','$emailidf','$emailids','$password','$admintype','$status')";
       
        $result=dbConfig::run($query);
        if(!$result)
        {
          throw new Exception("Error In insert query", 1);
        }
        $data=array('status'=>'Sucess', 'msg'=>'Data Inserted successfully','result'=>$result);
      }
     }
        catch(Exception $e)
        {
          $data=array('status'=>'error','msg'=>$e->getMessage());
        }
        finally
        {
        return $data;
        }
   }
  //=================================      function for Get all staff=======================================

//=========================
   public static function getallstaff()
 {
      try
  {
        $query="SELECT * FROM admin WHERE admintype='1' ";
  
        $result=dbConfig::run($query);
  
    if(!$result)
           {
            throw new Exception("Error in query", 1);
           }
             $data=array('status'=>'Success','msg'=>'','result'=>$result);
       }
     
     
     catch(Exception $e)
     {
      $data=array('status'=>'error', 'msg'=>$e->getMessage());
     }
     finally
     {

      return $data;
       
     }
  }
  //=================================      function for update all staff=======================================
public static function fetchStaff($id)
 {
      try
  {
        $query="SELECT * FROM admin WHERE id='".$id."'";  
        $result=dbConfig::run($query);
      
       
    if(!$result)
           {
            throw new Exception("Error in query", 1);
           }
             $data=array('status'=>'Success','msg'=>'','result'=>$result);
       }
     
     
     catch(Exception $e)
     {
      $data=array('status'=>'error', 'msg'=>$e->getMessage());
     }
     finally
     {

      return $data;
       
     }
  }
    //============================================== Function for edit staff details
//=========================

  public static function editStaff($id,$fname,$lname,$emailidf,$emailids,$password,$admintype,$status)
 {
      try
  {
       $query="Update admin SET fname = '$fname', lname = '$lname', emailidf = '$emailidf', emailids = '$emailids', password = '$password', admintype = '$admintype' WHERE id='".$id."'";
      // print_r($query);
       
        $result=dbConfig::run($query);
     
       
    if(!$result)
           {
            throw new Exception("Error in query", 1);
           }
             $data=array('status'=>'Success','msg'=>'','result'=> $result);
       }
     
     
     catch(Exception $e)
     {
      $data=array('status'=>'error', 'msg'=>$e->getMessage(), 'query'=> $query);
     }
     finally
     {

      return $data;
       
     }
  }
  
  //=============================  Delete Function for staff===========================
  
  public static function deleteStaff($id)
  {
   try
   {
     
     $query="delete from admin where id='$id'";
     $result=dbConfig::run($query);
     if(!$result)
     {
       throw new Exception("Error In Delete query", 1);
     }
     $data=array('status'=>'Success', 'msg'=>'Record deleted successfully','result'=>$result);
   }
   catch(Exception $e)
   {
     $data=array('status'=>'error','msg'=>$e->getMessage());
   }
   finally
   {
     return $data;
   }
  }

  
  
    
}
?>