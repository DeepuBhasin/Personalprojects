<?php 
class dbConfig
{
  protected static $host="localhost";
  protected static $user="root";
  protected static $pass="";
  protected static $dbname="classes_project";

  static $con;

  function __construct()

 {
  self::$con=self::connect();
 }
 
//====================================================
//====================================================
 
 protected static function connect()
 {
    try
    {
      $link = mysqli_connect(self::$host,self::$user,self::$pass,self::$dbname);
      
      if(!$link)
      {
        throw new Exception(mysql_error($link), 1);
      }

      return $link;
    }
    catch (Exception $e)
    {
      echo "Error".$e->getMessage();
    }
 }


 public static function connclose()
 {
    mysqli_close(self::$con);
 }

 public static function run($query)
 {
  try
  {
    if(empty($query) && !isset($query))
    {
      throw new Exception("Error Processing Query", 1);
      
    }
    $result=mysqli_query(self::$con,$query);
    //self::connclose();
    return $result;
  }

  catch(Exception $e)
  {
    echo "Error".$e->getMessage();
  }
 }

}

?>