<?php
require_once("dbConfig.php");
class clientClass extends dbConfig
{
	public static $data;
	function __construct()
	{
	   parent::__construct();
	}

	public static function chkclientexist($cemailf)
	{
		try
		{ 
			$query="SELECT cemailf FROM client WHERE cemailf='".$cemailf."'";
			$result=dbConfig::run($query);
			if(!result)
			{
				throw new Exception("Error In client exist query", 1);
			}
			$count=mysqli_num_rows($result);
			if($count>2)
			{
				throw new Exception("User Already Exist", 1);
			}
			$data=array('status'=>'Success','msg'=>'','result'=>$result);
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



//============================================ Add new client function addnewclient() starts from here ==================================================//
    
    public static function addnewclient($cfname,$clname,$cemailf,$cemails,$cemailt,$cphone,$cmob,$currency,$cpassword,$cstreetaddress,$ccity,$cstate,$ccountry,$accountmanager,$revenuemanager,$supportrevenuemanager,$smomanager,$supportsmomanager)
   {
    try
     {
      $chkuser=self::chkclientexist($cemailf);
      if($chkuser['status']=='error')
      {
        $data=$chkuser;
      }
      else{
        $query = "INSERT INTO client(cfname,clname,cemailf,cemails,cemailt,cphone,cmob,currency,cpassword,cstreetaddress,ccity,cstate,ccountry,accountmanager,revenuemanager,supportrevenuemanager,smomanager,supportsmomanager)VALUES('$cfname','$clname','$cemailf','$cemails','$cemailt','$cphone','$cmob','$currency','$cpassword','$cstreetaddress','$ccity','$cstate','$ccountry','$accountmanager','$revenuemanager','$supportrevenuemanager','$smomanager','$supportsmomanager')";
       
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
  //=================================================== Add new client function addnewclient() ends here ===================================================//

  

   public static function getallclients()
   {
    try
    {
      $query="SELECT * FROM client ORDER BY cfname ASC";
      $result=dbConfig::run($query);
      if(!$result)
      {
        throw new Exception("Error In getallclients query", 1);
      }
      $data=array('status'=>'Success','msg'=>'Data Selected Successfully','result'=>$result);
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

   //*******************************************************
   //****************************************************

    public static function getallclientbyrenewid($renewalmanagerid)
   {
    try
    {
        
      $query="SELECT * FROM client WHERE renewal_manager='".$renewalmanagerid."'";
      $result=dbConfig::run($query);
      if(!$result)
      {
        throw new Exception("Error In getallclientbyid query", 1);
      }
      $data=array('status'=>'Success','msg'=>'Data Selected Successfully','result'=>$result);
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

    //==================================================function FetchClient() code starts here==================================================//

   public static function fetchClients($cid)
   {
    try
    {
      $query="SELECT * FROM client WHERE cid='$cid'";
      $result=dbConfig::run($query);
      if(!$result)
      {
        throw new Exception("Error while fetching records.", 1);
      }
      $data=array('status'=>'Success','msg'=>'Data fetched Successfully','result'=>$result);
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
    //==================================================function FetchClient() code starts here==================================================//


   //==================================================function EditClient()/UpdateClient() function code starts here==================================================//

   public static function editClient()
   {
    try
      {
        $query = "UPDATE client SET name = '$name', lastname = '$lastname', propertyname = '$propertyname', email = '$email', phone = '$phone', country = '$country', state = '$state', city = '$city', streetno = '$streetno', address = '$address', zip = '$zip', signup_manager = '$signup_manager', renewal_manager = '$renewal_manager', from_date = '$from_date', to_date = '$to_date', signup_amount = '$signup_amount', renewal_amount = '$renewal_amount', bestwestern = '$bestwestern', choice_hotels = '$choice_hotels', expedia = '$expedia', google = '$google', booking = '$booking', wyndyam = '$wyndyam', tripadvisor = '$tripadvisor', hotelcom = '$hotelcom', orbitz = '$orbitz', travelocity = '$travelocity', revinate = '$revinate', radison = '$radison', independhotel = '$independhotel', image = '$image', status = '$status' WHERE cid = '$cid'";
        $result=dbConfig::run($query);
        if(!$result)
        {
          throw new Exception("Error In edit query", 1);
        }
        $data=array('status'=>'Sucess', 'msg'=>'Data edited successfully','result'=>$result);
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

   //==================================================function EditClient()/UpdateClient() function code starts here==================================================//

      public static function getcountryname($countryid)
      {
    try
    {
      $query="SELECT * FROM countries WHERE id='$countryid'";
      $result=dbConfig::run($query);
       
      if(!$result)
      {
        throw new Exception("Error while fetching records.", 1);
      }
      $resultSet = mysqli_fetch_array($result);
      $data=array('status'=>'Success','msg'=>'Data fetched Successfully','result'=>$resultSet);
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


      public static function getstatename($stateid)
      {
    try
    {
      $query="SELECT * FROM  states WHERE id='$stateid'";
      $result=dbConfig::run($query);
       
      if(!$result)
      {
        throw new Exception("Error while fetching records.", 1);
      }
      $resultSet = mysqli_fetch_array($result);
      $data=array('status'=>'Success','msg'=>'Data fetched Successfully','result'=>$resultSet);
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

   

   public static function getcityname($cityid)
      {
    try
    {
      $query="SELECT * FROM  cities WHERE id='$cityid'";
      $result=dbConfig::run($query);
       
      if(!$result)
      {
        throw new Exception("Error while fetching records.", 1);
      }
      $resultSet = mysqli_fetch_array($result);
      $data=array('status'=>'Success','msg'=>'Data fetched Successfully','result'=>$resultSet);
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



