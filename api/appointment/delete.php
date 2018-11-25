<?php

require dirname( __FILE__ )."/../../config.php";

if($_SESSION["permission"] == "admin"){

	$db = new DatabaseController();
    $db->query("DELETE FROM childrenGuardians WHERE id=:id", array('id'=>$_GET['id']));
	$db->closeConnection();

	// set response code - 200 OK
	http_response_code(200);

	echo "1";

} else {
	$response = array("status" => 0, "msg" => "You have no permissions for this operation.");
	// set response code - 200 OK
	http_response_code(200);
	 
	// show response data in json format
	echo json_encode($response);
}
?>