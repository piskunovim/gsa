<?php

require dirname( __FILE__ )."/../../config.php";

if($_SESSION["permission"] == "admin"){

	$updateInvoice = new InvoiceController();
	$updateInvoice->setId($_POST['id']);

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

	$updateInvoice->setYears($years);
	$updateInvoice->setPaymentTerm1($paymentTerm1);
	$updateInvoice->setPaymentTerm2($paymentTerm2);
	$updateInvoice->setPaymentTerm3($paymentTerm3);
	$updateInvoice->setStatusTerm1($statusTerm1);
	$updateInvoice->setStatusTerm2($statusTerm2);
	$updateInvoice->setStatusTerm3($statusTerm3);
	$updateInvoice->setStatusTextTerm1($statusTextTerm1);
	$updateInvoice->setStatusTextTerm2($statusTextTerm2);
	$updateInvoice->setStatusTextTerm3($statusTextTerm3);
	$updateInvoice->setInvoiceLinkTerm1($invoiceLinkTerm1);
	$updateInvoice->setInvoiceLinkTerm2($invoiceLinkTerm2);
	$updateInvoice->setInvoiceLinkTerm3($invoiceLinkTerm3);

	//print_r($updateGuardian);
	//exit;
	$response = array("status" => 0, "msg" => "Failed to update invoice instance. Please, try again.");

	$invoiceUpdated = $updateInvoice->update(); // boolean
	if($invoiceUpdated){
		$response = array("status" => 1, "msg" => "Invoice instance updated successfully");
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