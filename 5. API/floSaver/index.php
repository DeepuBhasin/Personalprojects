<?php
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['addData'])){
		
		$parentComapnyName=$_POST['parentComapnyName'];
		$propertyManagerName=$_POST['propertyManagerName'];
		$managerPhoneNumber=$_POST['managerPhoneNumber'];
		$managerEmailAddress=$_POST['managerEmailAddress'];
		$addressOfProperty=$_POST['addressOfProperty'];
		$nameOfProperty=$_POST['nameOfProperty'];
			
		if(!empty($_POST['buildingIfApplicable'])){
			$addressOfProperty=$addressOfProperty.', '.$_POST['buildingIfApplicable'];	
		}
		$numbersOfMeters=$_POST['numbersOfMeters'];
		$material=$_POST['material'];
		$shutOffValve=$_POST['shutOffValve'];
		$waterMeterLocation=$_POST['waterMeterLocation'];
		$backflowPreventer=$_POST['backflowPreventer'];
		$backFlowPsi=$_POST['backFlowPsi'];
		$sppigotPsi=$_POST['sppigotPsi'];
		$boosterPumps=$_POST['boosterPumps'];
		$boosterPumpPsi=$_POST['boosterPumpPsi'];
		$onlineBilling=$_POST['onlineBilling'];
		$plumberCompany=$_POST['plumberCompany'];
		$additionalInfromation=$_POST['additionalInfromation'];
		$makeCall=$_POST['makeCall'];
		$floSaverRepresentative=$_POST['floSaverRepresentative'];
	

	// Configuration:
	$apiKey   = 'c664e506975e99aebe83dc24bac87884915cf289';
	$username = 'deepinder999@gmail.com';


	require_once('NutshellApi.php');
	$api = new NutshellApi($username, $apiKey);



	/* Start Manager Details */
	$params = array(
		'contact' => array(
			'name' => $propertyManagerName,
			'phone' => array(
				$managerPhoneNumber,
				'cell' => $managerPhoneNumber,
			),
		),
	);

	if(!(empty($managerEmailAddress))){
		$params['contact']['email'][0]=$managerEmailAddress;
	}

	$newContact = $api->call('newContact', $params);
	$newContactId = $newContact->id;

	/* End Manager Details */


	/*Star Company Details */
	$params = array(
		'account' => array(
			'name' => $nameOfProperty,
			'contacts' => array(
				array(
					'id' => $newContactId,
					'relationship' => 'Purchasing Manager'
				),
			),
			'customFields'=>array(
				'Parent Company'=>$parentComapnyName),
		),
	);
	$newAccount = $api->newAccount($params);
	$newAccountId = $newAccount->id;

	/* End Company Details*/




	// Finally, create a lead that includes the account we just added
	$params = array(
		'lead' => array(
			'primaryAccount' => array('id' => $newAccountId),
			// 'confidence' => 70,
			'market'   => array('id' => 1),
			'contacts' => array(
				array(
					'relationship' => 'First Contact',
					'id'           => $newContactId,
				),
			),
			'customFields'=>array(
				'# of Meters / Valves'=>$numbersOfMeters,
				'Pipe Material'=>$material,
				'Shut Off Valve Accessible?'=>$shutOffValve,
				'Water Main Location'=>$waterMeterLocation,
				'Is there a Backflow Preventer?'=>$backflowPreventer,
				'PSI @ Backflow'=>$backFlowPsi,
				'PSI @ Spigot'=>$sppigotPsi,
				'Building Booster Pump?'=>$boosterPumps,
				'PSI @ Booster Pump'=>$boosterPumpPsi,
				'Online Billing Available?'=>$onlineBilling,
				'Preferred Plumbing Company'=>$plumberCompany,
				'General Notes'=>$additionalInfromation,
				'Flosaver Sales Rep'=>'Bob Goldberg',
				'Proposed Date of Install'=>$makeCall,
				),
		),
	);

	$pipeSize=$_POST['pipeSize'];
	$count=count($_POST['pipeSize']);
	$pipeSizeText=array_values(array_filter($_POST['pipeSizeText']));
	for($i=0;$i<$count;$i++)
	{
		$params['lead']['customFields'][$pipeSize[$i]]=$pipeSizeText[$i];
	}
	$result = $api->newLead($params);


	if(isset($result->name)){
		$RandomAccountNumber = uniqid();
		$upload=$result->name.'-mainWaterLineImage-'.$RandomAccountNumber.($_FILES['mainWaterLineImage']['name']);
		$source=$_FILES['mainWaterLineImage']['tmp_name'];
		$target='ClientFiles/'.$upload;
		move_uploaded_file($source,$target);


		$RandomAccountNumber = uniqid();
		$upload=$result->name.'-waterBills-'.$RandomAccountNumber.($_FILES['waterBills']['name']);
		$source=$_FILES['waterBills']['tmp_name'];
		$target='ClientFiles/'.$upload;
		move_uploaded_file($source,$target);

		$color='success';
		$message='From Submitted Successfuly. Your Lead Id is '.$result->name;


	}else{

		$color='danger';
		$message='Getting Error. Try after some time.';
	}

	header('location:index.php?color='.$color.'&message='.$message);

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FloSave Submittion Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
    	body{background-color: #99d6ff !important;}
    </style>
</head>

<body>
    <div class="container" >
        <center>
            <div class="jumbotron">
                <p><img src="logo.png" alt="" class="img-responsive"></p>
                <p>Property Information Form.</p>
                <p>Please provide as much information as possible.</p>
        </center>
        </div>
    </div>
    <div class="container">
    	<?php if(isset($_GET['color'])){?>
    	<div class="alert alert-<?= $_GET['color']?>">
    		<?= $_GET['message']?>
    		
    	</div>

    	<?php }?>
        <form action="<?= $_SERVER['PHP_SELF'];?>" method="POST"  enctype="multipart/form-data">
            <div class="form-group">
                <label for="parentComapnyName" class="form-label">Parent Company Name *</label>
                <input type="text" name="parentComapnyName" class="form-control" id="parentComapnyName" required="" placeholder="(ie: Acme Crop)">
            </div>
            <div class="form-group">
                <label for="propertyManagerName" class="form-label">What is the name of the Property Manager. *</label>
                <input type="text" name="propertyManagerName" class="form-control" id="propertyManagerName" required="" placeholder="(Contact Name)">
            </div>
             <div class="form-group">
                <label for="managerPhoneNumber" class="form-label">Contact Phone Number. *</label>
                <input type="text" name="managerPhoneNumber" class="form-control" id="managerPhoneNumber" required="" placeholder="(Area Code) (Phone Number)">
            </div>
             <div class="form-group">
                <label for="managerEmailAddress" class="form-label">Email Address of Property Manager.</label>
                <input type="email" name="managerEmailAddress" class="form-control" id="managerEmailAddress"  placeholder="(abc@abc.com)">
            </div>
             <div class="form-group">
                <label for="nameOfProperty" class="form-label">What is the Name Of Property? *</label>
                <input type="text" name="nameOfProperty" class="form-control" id="nameOfProperty" required=""  placeholder="(ex: Lakeside Vista)">
            </div>
            <div class="form-group">
              <label for="addressOfProperty" class="form-label">Address of Property *</label>
              <textarea name="addressOfProperty" class="form-control" id="addressOfProperty" rows="3" required="" placeholder="( ex: 1234 Lakeside Dr, Wellington Florida 33414 )"></textarea>
            </div>
              <div class="form-group">
                <label for="buildingIfApplicable" class="form-label">Building # If Applicable</label>
                <input type="text" name="buildingIfApplicable" class="form-control" id="buildingIfApplicable" placeholder="Building # If Applicable">
            </div>
            <div class="form-group">
                <label for="numbersOfMeters" class="form-label">How many water meters are on property? *</label>
                <input type="text" name="numbersOfMeters" class="form-control" id="numbersOfMeters" required="" placeholder="( ex: 4 meters )">
            </div>
           
            <div class="mb-3 form-check form-group">
                <label class="form-label">What size water meters are on the property ( Please choose ) if multiple please specify all.</label>
                <br/>

                <input type="checkbox" name="pipeSize[]" value='Valve Size QTY 1.5"' class="form-check-input" onchange="enterText(this);" id="pipeSize1">
                <label class="form-check-label" for="pipeSize1">1.5 Pipe</label>
                <input type="number" name="pipeSizeText[]" class="form-control" id="textpipeSize1" style="display: none" placeholder="( Enter Quantity )">
                <br/>

                <input type="checkbox" name="pipeSize[]" value='Valve Size QTY 2"' class="form-check-input" onchange="enterText(this);" id="pipeSize2">
                <label class="form-check-label" for="pipeSize2">2 Pipe</label>
                <input type="number" name="pipeSizeText[]" class="form-control" id="textpipeSize2" style="display: none" placeholder="( Enter Quantity )">
                <br/>

                <input type="checkbox" name="pipeSize[]" value='Valve Size QTY 3"' class="form-check-input" onchange="enterText(this);" id="pipeSize3">
                <label class="form-check-label" for="pipeSize3">3 Pipe</label>
                <input type="number" name="pipeSizeText[]" class="form-control" id="textpipeSize3" style="display: none" placeholder="( Enter Quantity )"><br/>

                <input type="checkbox" name="pipeSize[]" value='Valve Size QTY 4"' class="form-check-input" onchange="enterText(this);" id="pipeSize4">
                <label class="form-check-label" for="pipeSize4">4 Pipe</label>
                <input type="number" name="pipeSizeText[]" class="form-control" id="textpipeSize4" style="display: none" placeholder="( Enter Quantity )"><br/>

                <input type="checkbox" name="pipeSize[]" value='Valve Size QTY 6"' class="form-check-input" onchange="enterText(this);" id="pipeSize6">
                <label class="form-check-label" for="pipeSize6">6 Pipe</label>
                <input type="number" name="pipeSizeText[]" class="form-control" id="textpipeSize6" style="display: none" placeholder="( Enter Quantity )"><br/>

                <input type="checkbox" name="pipeSize[]" value='Valve Size QTY 8"' class="form-check-input" onchange="enterText(this);" id="pipeSize8">
                <label class="form-check-label" for="pipeSize8">8 Pipe</label>
                <input type="number" name="pipeSizeText[]" class="form-control" id="textpipeSize8" style="display: none" placeholder="( Enter Quantity )"><br/>

                <input type="checkbox" name="pipeSize[]" value='Valve Size QTY 10"' class="form-check-input" onchange="enterText(this);" id="pipeSize10">
                <label class="form-check-label" for="pipeSize10">10 Pipe</label>
                <input type="number" name="pipeSizeText[]" class="form-control" id="textpipeSize10" style="display: none" placeholder="( Enter Quantity )"><br/>
            </div>
            <div class="form-group">
                <label class="form-check-label" for="material">What material Is the water Main ( Please choose )</label>
                <select name="material" id="material" class="form-control" aria-label="Default select example" required="" >
                  <option value="">Select Material</option>
                  <option value="Cast Iron">Cast Iron</option>
                  <option value="Copper">Copper</option>
                  <option value="Galvanized">Galvanized</option>
                  <option value="PVC SCH 40">PVC SCH 40</option>
                  <option value="PVC SCH 80">PVC SCH 80</option>
                </select>
            </div>
             <div class="form-group">
                <label class="form-check-label" for="shutOffValve">Can the water main be shut off at the meter ? Is There a Shut Off Valve that works ? ( Please choose ) *</label>
                <select name="shutOffValve" id="shutOffValve" class="form-control" aria-label="Default select example" required="" >
                  <option value="">Select Shut Off Valve</option>
                  <option value="No">No</option>
                  <option value="Unknown">Unknown</option>
                  <option value="Yes">Yes</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-check-label" for="waterMeterLocation">Is The Water Main Above Ground Or Below ( Please choose ) *</label>
                <select name="waterMeterLocation" id="waterMeterLocation" class="form-control" aria-label="Default select example" required="" >
                  <option value="">Select Location</option>
                  <option value="Above Ground">Above Ground</option>
                  <option value="Below Ground">Below Ground</option>
                  <option value="Unsure">Unsure</option>
                </select>
            </div>
             <div class="form-group">
                <label class="form-check-label" for="backflowPreventer">Does this meter have a Backflow preventer ? ( Please choose ) *</label>
                <select name="backflowPreventer" id="backflowPreventer" class="form-control" aria-label="Default select example" required="" >
                  <option value="">Select BackFlow Preventer</option>
                  <option value="No">No</option>
                  <option value="Unknown">Unknown</option>
                  <option value="Yes">Yes</option>
                </select>
            </div>
              <div class="form-group">
                <label class="form-check-label" for="backFlowPsi">What is the PSI ( Pressure ) reading from backflow ? ( Please choose ) *</label>
                <select name="backFlowPsi" id="backFlowPsi" class="form-control" aria-label="Default select example" required="" >
                  <option value="">Select PSI Backflow</option>
                  <option value="40-50 PSI">40-50 PSI</option>
                  <option value="50-60 PSI">50-60 PSI</option>
                  <option value="60-75 PSI">60-75 PSI</option>
                  <option value="75-90 PSI">75-90 PSI</option>
                  <option value="90-110 PSI">90-110 PSI</option>
                  <option value="Above 110 PSI">Above 110 PSI</option>
                  <option value="Below 40 PSI">Below 40 PSI</option>
                </select>
            </div>
             <div class="form-group">
                <label class="form-check-label" for="sppigotPsi">What is the PSI ( Pressure ) reading from water spigot ? ( Please choose ) *</label>
                <select name="sppigotPsi" id="sppigotPsi" class="form-control" aria-label="Default select example" required="" >
                  <option value="">Select PSI Spigot</option>
                  <option value="40-50 PSI">40-50 PSI</option>
                  <option value="50-60 PSI">50-60 PSI</option>
                  <option value="60-75 PSI">60-75 PSI</option>
                  <option value="75-90 PSI">75-90 PSI</option>
                  <option value="90-110 PSI">90-110 PSI</option>
                  <option value="Above 110 PSI">Above 110 PSI</option>
                  <option value="Below 40 PSI">Below 40 PSI</option>
                </select>
            </div>
             <div class="form-group">
                <label class="form-check-label" for="boosterPumps">Does this system have any booster pumps ? ( Please choose ) *</label>
                <select name="boosterPumps" id="boosterPumps" class="form-control" aria-label="Default select example" required="" >
                  <option value="">Select Booster Pump</option>
                  <option value="No">No</option>
                  <option value="Unsure">Unsure</option>
                  <option value="Yes">Yes</option>
                </select>
            </div>
            <div class="form-group">
                <label for="boosterPumpPsi" class="form-label">What is the Suction to the Booster pump PSI ? </label>
                <input type="text" name="boosterPumpPsi" class="form-control" id="boosterPumpPsi"  placeholder="( ex: 45psi, 60psi, 80psi )">
            </div>
            <div class="form-group">
                <label class="form-check-label" for="onlineBilling">Do you have Access to online water billing ? ( Please choose ) *</label>
                <select name="onlineBilling" id="onlineBilling" class="form-control" aria-label="Default select example" required="" >
                  <option value="">Select Online Water Billing</option>
                  <option value="No">No</option>
                  <option value="Unknown">Unknown</option>
                  <option value="Yes">Yes</option>
                </select>
            </div>
            <div class="form-group">
                <label for="plumberCompany" class="form-label">Do you have a Plumber that is familiar with your system? If so what is the company name ? *</label>
                <input type="text" name="plumberCompany" class="form-control" id="plumberCompany" required="" placeholder="( Yes , Acme Plumbing )">
            </div>
              <div class="form-group">
                <label for="mainWaterLineImage" class="form-label">Please provide Pictures of the main water line. ( meter, backflow) *</label>
                <input type="file" name="mainWaterLineImage" class="form-control" id="mainWaterLineImage" required="">
            </div>
            <div class="form-group">
                <label for="waterBills" class="form-label">Please provide your last 24-36 months of water bills for our analysis of your system to calibrate the appropriate valve for your property. If file is to large please provide dropbox or equivalent link in the further information section below *</label>
                <input type="file" name="waterBills" class="form-control" id="waterBills" required="">
            </div>
            <!-- <div class="form-group">
                <label for="occupancyRates" class="form-label">Please provide occupancy rates or manufacturing capacity for the last 24-36 months. ? *</label>
                <input type="text" name="occupancyRates" class="form-control" id="occupancyRates" required="" placeholder="75%">
            </div> -->
            <div class="form-group">
              <label for="additionalInfromation" class="form-label">Please provide any additional information that might be useful.</label>
              <textarea name="additionalInfromation" class="form-control" id="additionalInfromation" rows="3" placeholder="Additional Information"></textarea>
            </div>
            <div class="form-group">
              <label for="makeCall" class="form-label">Please schedule a follow up call with Flosaver to review property information.</label>
              <input type="date" name="makeCall" class="form-control" id="makeCall">
            </div>
            <div class="form-group">
              <label for="floSaverRepresentative" class="form-label">Who is your Flosaver Account Representative ? * ( Please choose )</label>
              <select name="floSaverRepresentative" id="floSaverRepresentative" class="form-control" aria-label="Default select example" required="" >
                  <option value="">Select Representative</option>
                  <option value="Bob Goldberg">Bob Goldberg</option>
                  <option value="Casey Fand">Casey Fand</option>
                  <option value="Chris Winter">Chris Winter</option>
                  <option value="David Fried">David Fried</option>
                  <option value="Henry Siegel">Henry Siegel</option>
                  <option value="Josh Abolafia">Josh Abolafia</option>
                  <option value="Ken Bass">Ken Bass</option>
                  <option value="Kevin Gardner">Kevin Gardner</option>
                  <option value="Michael Ferraro">Michael Ferraro</option>
                  <option value="Osceola Operations">Osceola Operations</option>
                  <option value="PBH20 - Craig Tanner">PBH20 - Craig Tanner</option>
                  <option value="PBH20 - Dave Grad">PBH20 - Dave Grad</option>
                  <option value="PBH20 - Ike Abolafia">PBH20 - Ike Abolafia</option>
                  <option value="PBH20 - Tony Musto">PBH20 - Tony Musto</option>
                  <option value="Todd Vaccerello">Todd Vaccerello</option>
                  <option value="Tre Zimmerman">Tre Zimmerman</option>
                  <option value="Vectrus - Mike Wells">Vectrus - Mike Wells</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="addData">Submit</button>
            <button type="submit" class="btn btn-danger">Reset</button>
        </form>
    </div>
    <br/>
    <br/>
    <br/>
    <script type="text/javascript">
    	function enterText(e){
    		var checkId = e.id;
			var myCheck=document.getElementById(checkId).checked 

			if(myCheck==true){
				document.getElementById('text'+checkId).style.display='Block';
				document.getElementById('text'+checkId).value='';
				document.getElementById('text'+checkId).setAttribute('required','true');
			}else{
				document.getElementById('text'+checkId).style.display='none';
				document.getElementById('text'+checkId).removeAttribute('required');
			}

    	}
    </script>
</body>

</html>