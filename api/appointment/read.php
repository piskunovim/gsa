<?php
require dirname( __FILE__ )."/../../config.php";

if($_SESSION["permission"] == "admin"){

	$db = new DatabaseController();
    $response = $db->query("SELECT cg.id, g.firstName, g.lastName, g.phoneNumber, g.familyType FROM childrenGuardians cg LEFT JOIN guardians g ON cg.guardianId=g.id WHERE childId=:childId", array('childId'=>$_GET['childId']));
	$db->closeConnection();

	// set response code - 200 OK
	http_response_code(200);
	 
	// show response data in json format
	echo json_encode($response);

} elseif (isset($_SESSION["loggedin"])){

	$db = new DatabaseController();
    $response = $db->query("SELECT cg.id, g.firstName, g.lastName, g.phoneNumber, g.familyType FROM childrenGuardians cg LEFT JOIN guardians g ON cg.guardianId=g.id WHERE childId=:childId", array('childId'=>$_SESSION["childId"]));
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