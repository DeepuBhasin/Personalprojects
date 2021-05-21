<?php 
require_once("dbConfig.php");

/**
 * 
 */
class dashboardClass extends dbConfig
{
	public static $data;
	function __construct()

	{
		 parent::__construct();
	}

    public static function countstaff()
    {
    	 try
   	{
   	 $query="SELECT * from adminlogin";
     $result=dbConfig::run($query);
     if(!result)
     {
     	throw new Exception("Error In User Exit query", 1);
     }
     $count=mysqli_num_rows($result);
     $data=array('status'=>'Success','msg'=>'','result'=>$count);
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



    public static function countclient()
    {
    	 try
   	{
   	 $query="SELECT * from client";
     $result=dbConfig::run($query);
     if(!result)
     {
     	throw new Exception("Error In User Exit query", 1);
     }
     $count=mysqli_num_rows($result);
     $data=array('status'=>'Success','msg'=>'','result'=>$count);
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

    public static function countreview()
    {
    	 try
   	{
   	 $query="SELECT * from feedback";
     $result=dbConfig::run($query);
     if(!result)
     {
     	throw new Exception("Error In User Exit query", 1);
     }
     $count=mysqli_num_rows($result);
     $data=array('status'=>'Success','msg'=>'','result'=>$count);
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


      public static function countreviewbystaff($bystaffid)
    {
         try
    {
     $query="SELECT * from feedback WHERE staffid='".$bystaffid."'";
     $result=dbConfig::run($query);
     if(!result)
     {
        throw new Exception("Error In User Exit query", 1);
     }
     $count=mysqli_num_rows($result);
     $data=array('status'=>'Success','msg'=>'','result'=>$count);
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

    public static function countreviewbystaffdate($bystaffid,$reviewdate)
    {
         try
    {
     $query="SELECT * from feedback WHERE staffid='".$bystaffid."' AND date_review='".$reviewdate."'";
     $result=dbConfig::run($query);
     if(!result)
     {
        throw new Exception("Error In User Exit query", 1);
     }
     $count=mysqli_num_rows($result);
     $data=array('status'=>'Success','msg'=>'','result'=>$count);
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

 public static function PortalwiseDashboardData($startdate,$enddate,$type,$staffid)
    {
        try
            {
                if($type == "Team")
                {
                    $query="SELECT DISTINCT reviewportal,colorcode,count(reviewportal) as num FROM `feedback` where date_review between '$startdate' and '$enddate' and reviewportal!='' group by reviewportal,colorcode order by num DESC";
                    $result=dbConfig::run($query);
                        if(!$result)
                        {
                        throw new Exception("Error In User Exit query", 1);
                        }
                    $data=array('status'=>'Success','msg'=>'','result'=>$result);
                }else if($type == "My")
                {
                    $query="SELECT DISTINCT reviewportal,colorcode, count(reviewportal) as num FROM `feedback` where date_review between '$startdate' and '$enddate' and reviewportal!='' and staffid='$staffid' group by reviewportal,colorcode order by num DESC";
                    $result=dbConfig::run($query);
                        if(!$result)
                        {
                        throw new Exception("Error In User Exit query", 1);
                        }
                    $data=array('status'=>'Success','msg'=>'','result'=>$result);
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


 public static function ReviewOverviewDashboardData($startdate,$enddate,$type,$staffid)
    {
        try
            {
                if($type == "Team")
                {

                    $query="SELECT (select count(reviewstatus) FROM `feedback` where date_review between '$startdate' and '$enddate' and reviewportal!='' and reviewstatus!='' and reviewstatus='Positive'  group by reviewstatus) as posnum, (select count(reviewstatus) FROM `feedback` where date_review between '$startdate' and '$enddate' and reviewportal!='' and reviewstatus!='' and reviewstatus='Negative' group by reviewstatus) as negnum,(select count(reviewstatus) FROM `feedback` where date_review between '$startdate' and '$enddate' and reviewportal!='' and reviewstatus!='' and reviewstatus='Neutral' group by reviewstatus) as ntrnum";
                    
                    $result=dbConfig::run($query);
                        if(!$result)
                        {
                        throw new Exception("Error In User Exit query", 1);
                        }
                    $data=array('status'=>'Success','msg'=>'','result'=>$result);
                }else if($type == "My")
                {
                    $query="SELECT (select count(reviewstatus) FROM `feedback` where date_review between '$startdate' and '$enddate' and reviewportal!='' and reviewstatus!='' and reviewstatus='Positive' and staffid='$staffid' group by reviewstatus) as posnum,(select count(reviewstatus) FROM `feedback` where date_review between '$startdate' and '$enddate' and reviewportal!='' and reviewstatus!='' and reviewstatus='Negative' and staffid='$staffid' group by reviewstatus) as negnum,(select count(reviewstatus) FROM `feedback` where date_review between '$startdate' and '$enddate' and reviewportal!='' and reviewstatus!='' and reviewstatus='Neutral' and staffid='$staffid' group by reviewstatus) as ntrnum";

                    $result=dbConfig::run($query);
                        if(!$result)
                        {
                        throw new Exception("Error In User Exit query", 1);
                        }
                    $data=array('status'=>'Success','msg'=>'','result'=>$result);
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





public static function countreport()
    {
    	 try
   	{
   	 $query="SELECT * from reviewreport";
     $result=dbConfig::run($query);
     if(!result)
     {
     	throw new Exception("Error In User Exit query", 1);
     }
     $count=mysqli_num_rows($result);
     $data=array('status'=>'Success','msg'=>'','result'=>$count);
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