<?php

require dirname( __FILE__ )."/../../config.php";

//print_r($_POST);

if($_SESSION["permission"] == "admin"){

	$createChild = new ChildController();

	if(!isset($_POST['firstName'])){
		echo json_encode(array("status" => 0, "msg" => "Failed to create child. First name is not set."));	
		exit;
	}

	if(!isset($_POST['lastName'])){
		echo json_encode(array("status" => 0, "msg" => "Failed to create child. Last name is not set."));
		exit;
	}

	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$gender      = (isset($_POST['gender'])) ?  $_POST['gender'] : null;
	$dateOfBirth = (isset($_POST['dateOfBirth'])) ?  $_POST['dateOfBirth'] : null;
	$dateOfEntry = (isset($_POST['dateOfEntry'])) ?  $_POST['dateOfEntry'] : null;
	$phoneNumber = (isset($_POST['phoneNumber'])) ?  $_POST['phoneNumber'] : null;



	$createChild->setFirstName($firstName);
	$createChild->setLastName($lastName);
	$createChild->setGender($gender);
	$createChild->setDateOfBirth($dateOfBirth);
	$createChild->setDateOfEntry($dateOfEntry);
	$createChild->setPhoneNumber($phoneNumber);

	//print_r($createChild);
	//exit;
	$response = array("status" => 0, "msg" => "Failed to create child. Please, try again.");

	$createdChildId = $createChild->create();
	if($createdChildId){
		$response = array("status" => 1, "msg" => "Created new child with id: ".$createdChildId );
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