<?php

require dirname( __FILE__ )."/../../config.php";

if($_SESSION["permission"] == "admin"){

	$children = new ChildController();
	if(isset($_GET['childId'])){
		$children->setId($_GET['childId']);
		$response = $children->get();
	} else {
		$response = $children->get();
	}

	// set response code - 200 OK
	http_response_code(200);
	 
	// show response data in json format
	echo json_encode($response);
} elseif (isset($_SESSION["loggedin"])){

	$children = new ChildController();
	$children->setId($_SESSION['childId']);
	$response = $children->get();

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