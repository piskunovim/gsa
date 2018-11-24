<?php

require dirname( __FILE__ )."/../../config.php";

$removeChildSheetInstance = new ChildSheetController();
$removeChildSheetInstance->setId($_GET['id']);
$removeChildSheetInstance->delete();

$response = array("status" => 1, "msg" => "Child sheet instance has been deleted." );

// set response code - 200 OK
http_response_code(200);
 
// show response data in json format
echo json_encode($response);


?>