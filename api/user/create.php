<?php

require dirname( __FILE__ )."/../../config.php";

if($_SESSION["permission"] == "admin"){
	//print_r($_POST);

	$createUser = new UserController();

	$err = false;

	 // Validate username
	$createUser->setUsername($_POST["username"]);
	$createUser->setEmail($_POST['email']);
	// Checking username for existence
	if($createUser->checkForExistenceByUsername()){
		$errText = "This username is already taken.";
		$response = array("status" => 0, "msg" => $errText);
		echo json_encode($response);
		exit;
	}

	if($createUser->checkForExistenceByEmail()){
		$errText = "This email is already taken.";
		$response = array("status" => 0, "msg" => $errText);
		echo json_encode($response);
		exit;
	}

	$createUser->setPassword($_POST['newPassword']);

	if(isset($_POST['firstName'])){
		$createUser->setFirstName($_POST['firstName']);
	}
	if(isset($_POST['lastName'])){
		$createUser->setLastName($_POST['lastName']);
	}
	if(isset($_POST['gender'])){
		$createUser->setGender($_POST['gender']);
	}
	if(isset($_POST['dateOfBirth'])){
		$createUser->setDateOfBirth($_POST['dateOfBirth']);
	}
	if(isset($_POST['dateOfEntry'])){
		$createUser->setDateOfEntry($_POST['dateOfEntry']);
	}
	if(isset($_POST['addressLine1'])){
		$createUser->setAddressLine1($_POST['addressLine1']);
	}
	if(isset($_POST['addressLine2'])){
		$createUser->setAddressLine2($_POST['addressLine2']);
	}
	if(isset($_POST['city'])){
		$createUser->setCity($_POST['city']);
	}
	if(isset($_POST['phoneNumber'])){
		$createUser->setPhoneNumber($_POST['phoneNumber']);
	}
	if(isset($_POST['familyType'])){
		$createUser->setFamilyType($_POST['familyType']);
	}
	if(isset($_POST['categoryId'])){
		$createUser->setCategoryId($_POST['categoryId']);
	}

	//print_r($createUser);
	//exit;
	$response = array("status" => 0, "msg" => "Failed to create user. Please, try again.");

	$createdUserId = $createUser->create();
	if($createdUserId){
		$response = array("status" => 1, "msg" => "Created new user with id: ".$createdUserId );
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