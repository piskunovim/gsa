<?php

require dirname( __FILE__ )."/../../config.php";

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

?>