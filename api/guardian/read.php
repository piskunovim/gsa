<?php

require dirname( __FILE__ )."/../../config.php";

$guardians = new GuardianController();
$response = $guardians->get();

// set response code - 200 OK
http_response_code(200);
 
// show response data in json format
echo json_encode($response);

?>