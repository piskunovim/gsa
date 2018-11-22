<?php

require dirname( __FILE__ )."/../../config.php";

$users = new UserController();
$response = $users->get();

// set response code - 200 OK
http_response_code(200);
 
// show response data in json format
echo json_encode($response);

?>