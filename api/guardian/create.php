<?php

require dirname( __FILE__ )."/../../config.php";

//print_r($_POST);

$createGuardian = new GuardianController();

if(!isset($_POST['firstName'])){
	echo json_encode(array("status" => 0, "msg" => "Failed to create guardian. First name is not set."));	
	exit;
}

if(!isset($_POST['lastName'])){
	echo json_encode(array("status" => 0, "msg" => "Failed to create guardian. Last name is not set."));
	exit;
}

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$addressLine1 = (isset($_POST['addressLine1'])) ?  $_POST['addressLine1'] : null;
$addressLine2 = (isset($_POST['addressLine2'])) ?  $_POST['addressLine2'] : null;
$phoneNumber = (isset($_POST['phoneNumber'])) ?  $_POST['phoneNumber'] : null;
$familyType = (isset($_POST['familyType'])) ?  $_POST['familyType'] : null;

$createGuardian->setFirstName($firstName);
$createGuardian->setLastName($lastName);
$createGuardian->setAddressLine1($addressLine1);
$createGuardian->setAddressLine2($addressLine2);
$createGuardian->setPhoneNumber($phoneNumber);
$createGuardian->setFamilyType($familyType);

//print_r($createGuardian);
//exit;
$response = array("status" => 0, "msg" => "Failed to create guardian. Please, try again.");

$createdGuardianId = $createGuardian->create();
if($createdGuardianId){
	$response = array("status" => 1, "msg" => "Created new guardian with id: ".$createdGuardianId );
}

// set response code - 200 OK
http_response_code(200);
 
// show response data in json format
echo json_encode($response);


?>