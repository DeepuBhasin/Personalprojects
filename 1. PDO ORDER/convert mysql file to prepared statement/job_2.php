<?php



$dbhost = "localhost";
$dbusr = "root";
$dbpwd = "";
$dbname = "prepared_database";

//my skype id is Deepinder999 or Deepinder999@gmail.com 
// plz message me over there mate.


function getAgencyName($agencyID){

global $dbhost;
global $dbusr;
global $dbpwd;
global $dbname;
global $cipher;
global $mode;
	
try{
		$DBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusr, $dbpwd);
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		// binding Parameters and provide name to parameters 
		$stmt = $DBH->prepare("SELECT * FROM agencies WHERE agencyID=:agencyID"); // 
    	
    	//Assigning Values to parameters  
    	$stmt->execute(['agencyID'=>$agencyID]);
    	
    	if($stmt->rowCount()>0)
    	{
    		// set the resulting array to object
		    while($row = $stmt->fetch(PDO::FETCH_OBJ))
		    {
		    	$agencyName = $row->agencyName;
				
		    }
    	}
    	
    	# close the connection
		$DBH = null;

		if(isset($agencyName))
		{
		    // return array 
			return $agencyName;  
		}
		else
		{
			return "No Record found";	
		}
	}

catch(PDOException $e)
    {
    echo $e->getMessage();
    }
}

 

function get_group_permissions($groupID,$clientID){

$num=0;

global $dbhost;
global $dbusr;
global $dbpwd;
global $dbname;
global $type;
$num=0;

try{
	
		$DBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusr, $dbpwd);
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		// binding Parameters and provide name to parameters 
		$stmt = $DBH->prepare("SELECT * FROM groupLinks WHERE groupID=:groupID AND clientID=:clientID");
    	
    	//Assigning Values to parameters  
    	$stmt->execute(['groupID'=>$groupID,'clientID'=>$clientID]);
    	
    	if($stmt->rowCount()>0)
    	{
    		// set the resulting array to object
		    while($row = $stmt->fetch(PDO::FETCH_OBJ))
		    {
		    	$perms = $row->permissions;
		    	$num++;
			}
    	}
    	
    	# close the connection
		$DBH = null;

		if(isset($perms))
		{
			return $perms;
		}
		else
		{
			// echo "No Record found";
			// echo "<br/>";
			return "x";
			
		}

}

catch(PDOException $e)
    {
    echo $e->getMessage();
    }
}







function getThemeName($x){

global $dbhost;
global $dbusr;
global $dbpwd;
global $dbname;

$num=0;

try{
		$DBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusr, $dbpwd);
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// binding Parameters and provide name to parameters 
		$stmt = $DBH->prepare("SELECT * FROM styles WHERE x=:x");
    	
    	//Assigning Values to parameters  
    	$stmt->execute(['x'=>$x]);

    	if($stmt->rowCount()>0)
    	{
    		// set the resulting array to object
		    while($row = $stmt->fetch(PDO::FETCH_OBJ))
		    {
		    	$fileName = $row->file;
				$num++;
			}
    	}
    	
    	$DBH = null;

    	if(isset($fileName))
    	{
    		return $fileName;
    	}
    	else
		{
			return "No Record found";	
		}	
}

catch(PDOException $e)
    {
    echo $e->getMessage();
    }
}

function buildGroupArray($groupID){

$num=0;

global $dbhost;
global $dbusr;
global $dbpwd;
global $dbname;

$groupArray = array();

try{
		$DBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusr, $dbpwd);
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// binding Parameters and provide name to parameters 
		$stmt = $DBH->prepare("SELECT * FROM groupLinks WHERE groupID=:groupID");
    	
    	//Assigning Values to parameters  
    	$stmt->execute(['groupID'=>$groupID]);

    	if($stmt->rowCount()>0)
    	{
    		// set the resulting array to oject
		    while($row = $stmt->fetch(PDO::FETCH_OBJ))
		    {
		    	$groupArray[$num]= $row->clientID;
		    	++$num;
			}
    	}
    	
    	$DBH = null;

    	if($num>0)
    	{
    		return $groupArray;
    	}
    	else
		{
			return "No Record found";	
		}
}

catch(PDOException $e)
    {
    echo $e->getMessage();
    }
}

function groupNum($groupID){

$num=0;	

global $dbhost;
global $dbusr;
global $dbpwd;
global $dbname;

try{
		$DBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusr, $dbpwd);
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// binding Parameters and provide name to parameters 
		$stmt = $DBH->prepare("SELECT * FROM groupLinks WHERE groupID=:groupID");
    	
    	//Assigning Values to parameters  
    	$stmt->execute(['groupID'=>$groupID]);

    	$DBH = null;

    	if($stmt->rowCount()>0)
    	{
    		return $stmt->rowCount();
    	}
    	else
		{
			return "No Record found";	
		}
}

catch(PDOException $e)
    {
    echo $e->getMessage();
    }
}


print_r(getAgencyName(1));
print_r(get_group_permissions(2,2));
print_r(getThemeName(2));
print_r(buildGroupArray(3));
print_r(groupNum(13));
?>