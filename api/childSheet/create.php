<?php

require dirname( __FILE__ )."/../../config.php";

//print_r($_POST);

$createChildSheet = new ChildSheetController();

if(!isset($_POST['childId'])){
	echo json_encode(array("status" => 0, "msg" => "Failed to create child sheet instance. User id is not set."));	
	exit;
}

$childId = $_POST['childId'];
$date = (isset($_POST['date'])) ?  $_POST['date'] : null;
$period = (isset($_POST['period'])) ?  $_POST['period'] : null;
$presence = (isset($_POST['presence'])) ?  $_POST['presence'] : null;

$createChildSheet->setChildId($childId);
$createChildSheet->setDate($date);
$createChildSheet->setPeriod($period);
$createChildSheet->setPresence($presence);
//print_r($createGuardian);
//exit;
$response = array("status" => 0, "msg" => "Failed to create child sheet instance. Please, try again.");

$createdChildSheetId = $createChildSheet->create();
if($createdChildSheetId){
	$response = array("status" => 1, "msg" => "Created new child sheet instance with id: ".$createdChildSheetId );
}

// set response code - 200 OK
http_response_code(200);
 
// show response data in json format
echo json_encode($response);


?>