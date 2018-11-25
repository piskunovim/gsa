<?php

require dirname( __FILE__ )."/../../config.php";

if($_SESSION["permission"] == "admin"){

	$updateChildSheet = new ChildSheetController();
	$updateChildSheet->setId($_POST['id']);

	$date = (isset($_POST['date'])) ?  $_POST['date'] : null;
	$period = (isset($_POST['period'])) ?  $_POST['period'] : null;
	$presence = (isset($_POST['presence'])) ?  $_POST['presence'] : null;

	$updateChildSheet->setDate($date);
	$updateChildSheet->setPeriod($period);
	$updateChildSheet->setPresence($presence);

	//print_r($updateGuardian);
	//exit;
	$response = array("status" => 0, "msg" => "Failed to update child sheet instance. Please, try again.");

	$childSheetUpdated = $updateChildSheet->update(); // boolean
	if($childSheetUpdated){
		$response = array("status" => 1, "msg" => "Child sheet instance updated successfully");
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