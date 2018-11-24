<?php

require dirname( __FILE__ )."/../../config.php";

$removeChild = new ChildController();
$removeChild->setId($_GET['id']);
$removeChild->delete();

$response = array("status" => 1, "msg" => "Child had been deleted." );

// set response code - 200 OK
http_response_code(200);
 
// show response data in json format
echo json_encode($response);


?>