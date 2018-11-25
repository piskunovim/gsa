<?php

require dirname( __FILE__ )."/../../config.php";

if($_SESSION["permission"] == "admin"){

	//print_r($_POST);

	$createInvoice = new InvoiceController();

	if(!isset($_POST['childId'])){
		echo json_encode(array("status" => 0, "msg" => "Failed to create child sheet instance. User id is not set."));	
		exit;
	}

	$childId = $_POST['childId'];
	$years = (isset($_POST['years'])) ?  $_POST['years'] : null;
	$paymentTerm1 = (isset($_POST['paymentTerm1'])) ?  $_POST['paymentTerm1'] : null;
	$paymentTerm2 = (isset($_POST['paymentTerm2'])) ?  $_POST['paymentTerm2'] : null;
	$paymentTerm3 = (isset($_POST['paymentTerm3'])) ?  $_POST['paymentTerm3'] : null;
	$statusTerm1 = (isset($_POST['statusTerm1'])) ?  $_POST['statusTerm1'] : null;
	$statusTerm2 = (isset($_POST['statusTerm2'])) ?  $_POST['statusTerm2'] : null;
	$statusTerm3 = (isset($_POST['statusTerm3'])) ?  $_POST['statusTerm3'] : null;
	$statusTextTerm1 = (isset($_POST['statusTextTerm1'])) ?  $_POST['statusTextTerm1'] : null;
	$statusTextTerm2 = (isset($_POST['statusTextTerm2'])) ?  $_POST['statusTextTerm2'] : null;
	$statusTextTerm3 = (isset($_POST['statusTextTerm3'])) ?  $_POST['statusTextTerm3'] : null;
	$invoiceLinkTerm1 = (isset($_POST['invoiceLinkTerm1'])) ?  $_POST['invoiceLinkTerm1'] : null;
	$invoiceLinkTerm2 = (isset($_POST['invoiceLinkTerm2'])) ?  $_POST['invoiceLinkTerm2'] : null;
	$invoiceLinkTerm3 = (isset($_POST['invoiceLinkTerm3'])) ?  $_POST['invoiceLinkTerm3'] : null;


	$createInvoice->setChildId($childId);
	$createInvoice->setYears($years);
	$createInvoice->setPaymentTerm1($paymentTerm1);
	$createInvoice->setPaymentTerm2($paymentTerm2);
	$createInvoice->setPaymentTerm3($paymentTerm3);
	$createInvoice->setStatusTerm1($statusTerm1);
	$createInvoice->setStatusTerm2($statusTerm2);
	$createInvoice->setStatusTerm3($statusTerm3);
	$createInvoice->setStatusTextTerm1($statusTextTerm1);
	$createInvoice->setStatusTextTerm2($statusTextTerm2);
	$createInvoice->setStatusTextTerm3($statusTextTerm3);
	$createInvoice->setInvoiceLinkTerm1($invoiceLinkTerm1);
	$createInvoice->setInvoiceLinkTerm2($invoiceLinkTerm2);
	$createInvoice->setInvoiceLinkTerm3($invoiceLinkTerm3);
	//print_r($createGuardian);
	//exit;
	$response = array("status" => 0, "msg" => "Failed to create invoice instance. Please, try again.");

	$createdInvoiceId = $createInvoice->create();
	if($createdInvoiceId){
		$response = array("status" => 1, "msg" => "Created new invoice instance with id: ".$createdInvoiceId );
	}

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