<?php
require dirname( __FILE__ )."/../../config.php";

if($_SESSION["permission"] == "admin"){

	$invoice = new InvoiceController();
	$invoice->setChildId($_GET['childId']);
	$response = $invoice->get();

	// set response code - 200 OK
	http_response_code(200);
	 
	// show response data in json format
	echo json_encode($response);

} elseif (isset($_SESSION["loggedin"])){

	$invoice = new InvoiceController();
	$invoice->setChildId($_SESSION["childId"]);
	$response = $invoice->get();

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