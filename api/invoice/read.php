<?php

require dirname( __FILE__ )."/../../config.php";

$invoice = new InvoiceController();
$invoice->setChildId($_GET['childId']);
$response = $invoice->get();

// set response code - 200 OK
http_response_code(200);
 
// show response data in json format
echo json_encode($response);

?>