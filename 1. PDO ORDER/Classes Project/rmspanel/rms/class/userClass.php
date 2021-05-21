<?php 
 require_once("dbConfig.php");
 
 class userClass extends dbConfig
 {
   public static $data;

   function __construct()
   {
   	 parent::__construct();
   }

   //========================================================================

   public static function chkUserexist($username)
   {
   	try
   	{
   	 $query="SELECT username from admin WHERE username='".$username."'";
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

   public static function chkuser($username,$password)
   {
   	try 
   	{
      $query="SELECT username,password FROM admin WHERE username='".$username."' and password='".$password."'";

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

   public static function login($username,$password)
   {
     try
     {
	     $chklogin=self::chkuser($username,$password);
        

	     if($chklogin['status']=='error')
	     {
	        $data=$chklogin;
	     }
	     else
	     {
	     	$query="SELECT * FROM admin WHERE username='".$username."' and password='".$password."'";
	     	$result=dbConfig::run($query);
	     	if(!$result)
	         {
	         	throw new Exception("Error in query", 1);
	         }
	         $resultSet=mysqli_fetch_assoc($result);
            $_SESSION['login']=true;
            $_SESSION['id']= $resultSet['id'];
           
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

   public static function chkStaffexist($username)
   {
   	try
   	{
   	 $query="SELECT username from staff WHERE username='".$username."'";
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

   public static function chkstaff($username,$password)
   {
   	try 
   	{
      $query="SELECT username,password FROM staff WHERE username='".$username."' and password='".$password."'";

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

   public static function stafflogin($username,$password)
   {
     try
     {
	     $chklogin=self::chkstaff($username,$password);
        

	     if($chklogin['status']=='error')
	     {
	        $data=$chklogin;
	     }
	     else
	     {
	     	$query="SELECT * FROM staff WHERE username='".$username."' and password='".$password."'";
	     	$result=dbConfig::run($query);
	     	if(!$result)
	         {
	         	throw new Exception("Error in query", 1);
	         }
	         $resultSet=mysqli_fetch_assoc($result);
            $_SESSION['login']=true;
            $_SESSION['id']= $resultSet['id'];
           
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

public static function getid($id)
 {
      try
  {
      	$query="SELECT * FROM userdirectory ";	
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
    public static function approvetable()
  {
      try
  {
      	$query="SELECT * FROM userdirectory where approved='0'";	
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
  } //========================================================================
  public static function approvelisting($id)
 {
      try
  {
      	$query="Update userdirectory set approved='1' where id='".$id."'";	
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
  public static function getuserbyid($id)
  {
      try
      {
           $query ="select fname,mname,lname,username,password,emailid from userdirectory where id='".$id."' ";
      
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
  public static function approveduser($id)
 {
      try
  {
       $query ="select * from userdirectory where id=$id";
      
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
  public static function deactivateemail($id)
 {
      try
  {
      	$query="Update userdirectory set deactivateEmail='0' where id='".$id."'";	
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
  public static function getdatecount($id)
 {
      try
  {
      	$query="SELECT count(*) as numCount FROM userdirectory where date_of_registration between '2018-01-01' and '2018-12-31'";
      	
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
   public static function gettopten($ostate)
 {
      try
  {
      	$query="SELECT ostate, COUNT(ostate) as top FROM userdirectory GROUP BY ostate ORDER BY `top` DESC limit 10";
	
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
   public static function getdeactivateemail($id)
 {
      try
  {
      	$query="SELECT count(*) as email from userdirectory where deactivateEmail='0'";
	
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
     public static function registeredUsers($id)
 {
      try
  {
      	$query="SELECT date_of_registration,count(id) as registered_users FROM userdirectory WHERE date_of_registration>=(CURDATE()-INTERVAL 1 MONTH)
      	ORDER BY `userdirectory`.`date_of_registration` DESC ";
	
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
 
    public static function add_announcements($announcement,$photo)
 {
      try
  {
    
        $query="insert into Announcement (announcement,photo)values('$announcement','$photo')";

//echo($query);
//exit();
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
 
     public static function add_articles($title,$article,$photo)
 {
      try
  {
    
        $query="insert into Articles (title,article,photo)values('$title','$article','$photo')";


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
  
  //==================================================function registerstaff()/() function code starts here==================================================//

   public static function addstaff($fname,$lname,$email1,$email2,$username,$password)
   {
    try
      {
        $query = "INSERT INTO staff(fname,lname,email1,email2,username,password) VALUES('$fname','$lname','$email1','$email2','$username','$password')";
        $result=dbConfig::run($query);
        if(!$result)
        {
          throw new Exception("Error In insert query", 1);
        }
        $data=array('status'=>'Sucess', 'msg'=>'Data Inserted successfully','result'=>$result);
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
   public static function gettopten1($ostate)
 {
      try
  {
      	$query="SELECT ostate, COUNT(ostate) as top FROM userdirectory GROUP BY ostate ORDER BY `top` DESC limit 10";
	
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
}
?>