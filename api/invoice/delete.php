<?php

require dirname( __FILE__ )."/../../config.php";

if($_SESSION["permission"] == "admin"){

	$removeInvoice = new InvoiceController();
	$removeInvoice->setId($_GET['id']);
	$removeInvoice->delete();

	$response = array("status" => 1, "msg" => "Invoice instance has been deleted." );

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