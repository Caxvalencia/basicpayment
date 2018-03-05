<?php

namespace TestPlaceToPay\BasicPayment\Client\Models;

/**
 * Class TransactionInformation
 * @package TestPlaceToPay\BasicPayment\Client\Models
 */
class TransactionInformation
{
    private $transactionID; // int
    private $sessionID; // string
    private $reference; // string
    private $requestDate; // string
    private $bankProcessDate; // string
    private $onTest; // boolean
    private $returnCode; // string
    private $trazabilityCode; // string
    private $transactionCycle; // int
    private $transactionState; // string
    private $responseCode; // int
    private $responseReasonCode; // string
    private $responseReasonText; // string
}