<?php

require dirname( __FILE__ )."/../../config.php";

$removeUser = new UserController();
$removeUser->setId($_GET['id']);
$removeUser->delete();

$response = array("status" => 1, "msg" => "User had been deleted." );

// set response code - 200 OK
http_response_code(200);
 
// show response data in json format
echo json_encode($response);


?>