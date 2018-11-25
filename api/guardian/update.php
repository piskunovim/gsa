<?php

require dirname( __FILE__ )."/../../config.php";

if($_SESSION["permission"] == "admin"){

	$updateGuardian = new GuardianController();
	$updateGuardian->setId($_POST['id']);

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

	$updateGuardian->setFirstName($firstName);
	$updateGuardian->setLastName($lastName);
	$updateGuardian->setAddressLine1($addressLine1);
	$updateGuardian->setAddressLine2($addressLine2);
	$updateGuardian->setPhoneNumber($phoneNumber);
	$updateGuardian->setFamilyType($familyType);

	//print_r($updateGuardian);
	//exit;
	$response = array("status" => 0, "msg" => "Failed to update guardian. Please, try again.");

	$guardianUpdated = $updateGuardian->update(); // boolean
	if($guardianUpdated){
		$response = array("status" => 1, "msg" => "Guardian updated successfully");
	}

	// set response code - 200 OK
	http_response_code(200);
	 
	// show response data in json format
	echo json_encode($response);

} else {
	$response = array("status" => 0, "msg" => "You have no permissions for this operation.");
	// set response code - 200 OK
	http_response_code(200);
	 
	// show response data in json format
	echo json_encode($response);
}



?>