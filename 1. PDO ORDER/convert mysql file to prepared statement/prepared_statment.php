<?php

$dbhost = "localhost";
$dbusr = "root";
$dbpwd = "";
$dbname = "prepared_database";



function getLatestEpisode($clientIDx){
global $dbhost;
global $dbusr;
global $dbpwd;
global $dbname;
global $cipher;
global $mode;
$i=0;
	
try{
		$DBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusr, $dbpwd);
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		// binding Parameters and provide name to parameters 
		$stmt = $DBH->prepare("SELECT * FROM episodes WHERE clientID=:clientIDx AND end=:name_end ORDER BY :order_by"); // 
    	
    	//Assigning Values to parameters  
    	$stmt->execute(['clientIDx'=>$clientIDx,'name_end'=>'','order_by'=>'episodeID']);
    	
    	if($stmt->rowCount()>0)
    	{
    		// set the resulting array to object
		    while($row = $stmt->fetch(PDO::FETCH_OBJ))
		    {
		    	$episodeID[$i] = $row->episodeID;
				++$i;
		    }
    	}
    	
    	# close the connection
		$DBH = null;

		if(isset($episodeID))
		{
		    // return array 
			return $episodeID;  
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

 

function isValidClient($clientIDx,$authKey){

global $dbhost;
global $dbusr;
global $dbpwd;
global $dbname;
global $cipher;
global $mode;

$result=0;

try{
	
		$DBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusr, $dbpwd);
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		// binding Parameters and provide name to parameters 
		$stmt = $DBH->prepare("SELECT * FROM users WHERE authCode=:authKey AND userID=:clientIDx");
    	
    	//Assigning Values to parameters  
    	$stmt->execute(['authKey'=>$authKey,'clientIDx'=>$clientIDx]);
    	
    	if($stmt->rowCount()>0)
    	{
    		// set the resulting array to object
		    while($row = $stmt->fetch(PDO::FETCH_OBJ))
		    {
		    	$id = $row->userID;
			}
    	}
    	
    	# close the connection
		$DBH = null;

		if(isset($id))
		{
			if($id==$clientIDx)
			{
				$result=1;
				return $result;
			}
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







function getAge($clientIDx,$authKey){

global $dbhost;
global $dbusr;
global $dbpwd;
global $dbname;
global $cipher;
global $mode;

$result=0;

try{
		$DBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusr, $dbpwd);
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// binding Parameters and provide name to parameters 
		$stmt = $DBH->prepare("SELECT * FROM users WHERE authCode=:authKey AND userID=:clientIDx");
    	
    	//Assigning Values to parameters  
    	$stmt->execute(['authKey'=>$authKey,'clientIDx'=>$clientIDx]);

    	if($stmt->rowCount()>0)
    	{
    		// set the resulting array to object
		    while($row = $stmt->fetch(PDO::FETCH_OBJ))
		    {
		    	$joined = $row->joined;
				$bMonth = $row->bMonth;
				$bDay = $row->bDay;
				$bYear = $row->bYear;

				$ok=true;
			}
    	}
    	
    	$DBH = null;

    	if(isset($ok))
    	{
    		$x_bMonth = clean(x_decrypt($bMonth, $joined, $cipher, $mode));
			$x_bYear = clean(x_decrypt($bYear, $joined, $cipher, $mode));
			$x_bDay = clean(x_decrypt($bDay, $joined, $cipher, $mode));
			$today = new DateTime();
			$birthdate = new DateTime("$x_bYear-$x_bMonth-$x_bDay");
			$interval = $today->diff($birthdate);
				
			return $interval->format('%y');
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

function getBirthDate($clientIDx,$authKey){

global $dbhost;
global $dbusr;
global $dbpwd;
global $dbname;
global $cipher;
global $mode;

$result=0;

try{
		$DBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusr, $dbpwd);
		$DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// binding Parameters and provide name to parameters 
		$stmt = $DBH->prepare("SELECT * FROM users WHERE authCode=:authKey AND userID=:clientIDx");
    	
    	//Assigning Values to parameters  
    	$stmt->execute(['authKey'=>$authKey,'clientIDx'=>$clientIDx]);

    	if($stmt->rowCount()>0)
    	{
    		// set the resulting array to oject
		    while($row = $stmt->fetch(PDO::FETCH_OBJ))
		    {
		    	$joined = $row->joined;
				$bMonth = $row->bMonth;
				$bDay = $row->bDay;
				$bYear = $row->bYear;

				$ok=true;
			}
    	}
    	
    	$DBH = null;

    	if(isset($ok))
    	{
    		$x_bMonth = clean(x_decrypt($bMonth, $joined, $cipher, $mode));
			$x_bYear = clean(x_decrypt($bYear, $joined, $cipher, $mode));
			$x_bDay = clean(x_decrypt($bDay, $joined, $cipher, $mode));
			$value="$x_bYear-$x_bMonth-$x_bDay";
			return $value;
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

function getLocationName($locationID){

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
		$stmt = $DBH->prepare("SELECT * FROM locations WHERE locationID=:locationID");
    	
    	//Assigning Values to parameters  
    	$stmt->execute(['locationID'=>$locationID]);

    	if($stmt->rowCount()>0)
    	{
    		// set the resulting array to object
		    while($row = $stmt->fetch(PDO::FETCH_OBJ))
		    {
		    	$locationName = $row->locationName;
			}
    	}
    	else
		{
			return "No Record found";	
		}
    	
    	$DBH = null;

    	if(isset($locationName))
    	{
    		return $locationName;
    	}
}

catch(PDOException $e)
    {
    echo $e->getMessage();
    }
}

function getLocationAgency($locationID){

global $dbhost;
global $dbusr;
global $dbpwd;
global $dbname;
global $cipher;
global $mode;

$locationID = filter_var($locationID,FILTER_SANITIZE_NUMBER_INT);	

try{
		$DBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusr, $dbpwd);

		// binding Parameters and provide name to parameters 
		$stmt = $DBH->prepare("SELECT * FROM locations WHERE locationID=:locationID");
    	
    	//Assigning Values to parameters  
    	$stmt->execute(['locationID'=>$locationID]);

    	if($stmt->rowCount()>0)
    	{
    		// set the resulting array to object
		    while($row = $stmt->fetch(PDO::FETCH_OBJ))
		    {
		    	$agencyID = $row->agencyID;
			}
    	}
    	else
		{
			return "No Record found";	
		}
    	
    	$DBH = null;

    	if(isset($agencyID))
    	{
    		return $agencyID;
    	}
}

catch(PDOException $e)
    {
    echo $e->getMessage();
    }
}


// print_r(getLatestEpisode(1)); // function calling 

// print_r(isValidClient(3,3));

// print_r(getAge(1,1));

// print_r(getBirthDate(1,1));

// print_r(getLocationName(2));

// print_r(getLocationAgency(2));


?>