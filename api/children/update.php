<?php

require dirname( __FILE__ )."/../../config.php";


$updateChild = new ChildController();
$updateChild->setId($_POST['id']);

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

$updateChild->setFirstName($firstName);
$updateChild->setLastName($lastName);
$updateChild->setGender($gender);
$updateChild->setDateOfBirth($dateOfBirth);
$updateChild->setDateOfEntry($dateOfEntry);
$updateChild->setPhoneNumber($phoneNumber);

//print_r($updateChild);
//exit;
$response = array("status" => 0, "msg" => "Failed to update child. Please, try again.");

$childUpdated = $updateChild->update(); // boolean
if($childUpdated){
	$response = array("status" => 1, "msg" => "Child updated successfully");
}

// set response code - 200 OK
http_response_code(200);
 
// show response data in json format
echo json_encode($response);


?>