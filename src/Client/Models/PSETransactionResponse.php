<?php
namespace TestPlaceToPay\BasicPayment\Client\Models;

/**
 * PSETransactionResponse
 */
class PSETransactionResponse {

	private $returnCode; // string
	private $bankURL; // string
	private $trazabilityCode; // string
	private $transactionCycle; // int
	private $transactionID; // int
	private $sessionID; // string
	private $bankCurrency; // string
	private $bankFactor; // float
	private $responseCode; // int
	private $responseReasonCode; // string
	private $responseReasonText; // string

	function __construct() {
	}
}