<?php 
 require_once("dbConfig.php");
 
 class staffClass extends dbConfig
 {
   public static $data;

   function __construct()
   {
   	 parent::__construct();
   }

 //================= Inserting Data //========================================================================

   public static function insertData($data)
   {
    try
   	{
        $count=count($data['rangedate']);
        $transaction_count=0;
        $normal_count=0;
        for($i=0;$i<$count;$i++){
              
              $rangedate=date('Y-m-d',strtotime($data['rangedate'][$i]));
              $inventory=$data['inventory'][$i];
              $current_standard_room_rate=$data['current_standard_room_rate'][$i];
              $rate=$data['rate'][$i];
              $rcomended_rate_by_cyberwe=$data['rcomended_rate_by_cyberwe'][$i];              
              $neay_by_event=$data['neay_by_event'][$i];

              $query="SELECT * FROM hoteldata where rangedate=date('$rangedate')";
              $result=dbConfig::run($query);
              if(mysqli_num_rows($result)==0){
                 $query="INSERT INTO `hoteldata` (`rangedate`, `inventory`, `current_standard_room_rate`, `rate`, `rcomended_rate_by_cyberwe`, `neay_by_event`) VALUES ('$rangedate', '$inventory', '$current_standard_room_rate', '$rate', '$rcomended_rate_by_cyberwe', '$neay_by_event');";
               
                 $result=dbConfig::run($query);
               
               if($result){
                $transaction_count++;
               }
               $normal_count++;
              }
              else{
                 $query="UPDATE `hoteldata` set rangedate='$rangedate',inventory='$inventory',current_standard_room_rate='$current_standard_room_rate',rate='$rate',rcomended_rate_by_cyberwe=$rcomended_rate_by_cyberwe,neay_by_event='$neay_by_event' where rangedate=date('$rangedate')";
                 $result=dbConfig::run($query);   
              }
            }
      if($transaction_count==$normal_count)
       {
       	  $data=array('status'=>'success','msg'=>'','result'=>'');
       }
       else{
          
            throw new Exception("DataBase Problem. Try After some Time. Error : ".mysqli_error(dbConfig::$con), 1);
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

   public static function getAllData($data){
    $fromDate= date('Y-m-d',strtotime($_POST['fromDate']));
    $toDate= date('Y-m-d',strtotime($_POST['toDate']));


    $query="SELECT * FROM hoteldata where date(rangedate)>=date('$fromDate') and date('$toDate')>=date(rangedate) ORDER BY rangedate ASC";
   
     $result=dbConfig::run($query);
      try
    {
       
      if($result)
       {
            $data=array('status'=>'success','msg'=>'Data Selected Successfully','result'=>$result);
       }
       else{
          
            throw new Exception("DataBase Problem. Try After some Time. Error : ".mysqli_error(dbConfig::$con), 1);
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
  
}
?>