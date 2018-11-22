<?php

require dirname( __FILE__ )."/../../config.php";

$updateUser = new UserController();
$updateUser->setId($_POST['id']);

$existedUser = $updateUser->get();
//print_r($_POST);

$updateUser->setUsername($_POST['username']);

if(!empty($_POST['newPassword']) && !$updateUser->matchPasswords($_POST['newPassword'], $existedUser['password'])){
	$updateUser->setPassword($_POST['newPassword']);
}
if($existedUser['email'] != $_POST['email']){
	$updateUser->setEmail($_POST['email']);
}
if($existedUser['firstName'] != $_POST['firstName']){
	$updateUser->setFirstName($_POST['firstName']);
}
if($existedUser['lastName'] != $_POST['lastName']){
	$updateUser->setLastName($_POST['lastName']);
}
if($existedUser['gender'] != $_POST['gender']){
	$updateUser->setGender($_POST['gender']);
}
if($existedUser['dateOfBirth'] != $_POST['dateOfBirth']){
	$updateUser->setDateOfBirth($_POST['dateOfBirth']);
}
if($existedUser['dateOfEntry'] != $_POST['dateOfEntry']){
	$updateUser->setDateOfEntry($_POST['dateOfEntry']);
}
if($existedUser['addressLine1'] != $_POST['addressLine1']){
	$updateUser->setAddressLine1($_POST['addressLine1']);
}
if($existedUser['addressLine2'] != $_POST['addressLine2']){
	$updateUser->setAddressLine2($_POST['addressLine2']);
}
if($existedUser['city'] != $_POST['city']){
	$updateUser->setCity($_POST['city']);
}
if($existedUser['phoneNumber'] != $_POST['phoneNumber']){
	$updateUser->setPhoneNumber($_POST['phoneNumber']);
}
if($existedUser['familyType'] != $_POST['familyType']){
	$updateUser->setFamilyType($_POST['familyType']);
}
if($existedUser['categoryId'] != $_POST['categoryId']){
	$updateUser->setCategoryId($_POST['categoryId']);
}

//print_r($updateUser);
//exit;
$response = array("status" => 0, "msg" => "Failed to update user. Please, try again.");

$userUpdated = $updateUser->update(); // boolean
if($updateUser->update()){
	$response = array("status" => 1, "msg" => "User updated successfully");
}

// set response code - 200 OK
http_response_code(200);
 
// show response data in json format
echo json_encode($response);


?>