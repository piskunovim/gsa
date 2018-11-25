<?php

require dirname( __FILE__ )."/../../config.php";

if($_SESSION["permission"] == "admin"){

	
	if(!isset($_POST['childId'])){
		echo json_encode(array("status" => 0, "msg" => "Failed to update appointment instance. Child id is not set."));	
		exit;
	}

	if(!isset($_POST['guardianId'])){
		echo json_encode(array("status" => 0, "msg" => "Failed to update appointment instance. Guardian id is not set."));	
		exit;
	}

	$db = new DatabaseController();

    $response = $db->query("UPDATE childrenGuardians SET childId=:childId, guardianId=:guardianId WHERE id=:id", array('childId'=>$_POST['id'], 'childId'=>$_POST['childId'],'guardianId'=>$_POST['guardianId']));
	$db->closeConnection();

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