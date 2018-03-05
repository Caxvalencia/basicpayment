<?php

namespace TestPlaceToPay\BasicPayment\Client\Models;

use TestPlaceToPay\BasicPayment\RemoteAddress;

/**
 * PSETransaction
 */
class PSETransaction
{
    /**
     * @var string
     */
    private $bankCode;

    /**
     * @var string
     */
    private $bankInterface;

    /**
     * @var string
     */
    private $returnURL;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $language;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var double
     */
    private $totalAmount;

    /**
     * @var double
     */
    private $taxAmount;

    /**
     * @var double
     */
    private $devolutionBase;

    /**
     * @var double
     */
    private $tipAmount;

    /**
     * @var Person
     */
    private $payer;

    /**
     * @var Person
     */
    private $buyer;

    /**
     * @var Person
     */
    private $shipping;

    /**
     * @var string
     */
    private $ipAddress;

    /**
     * @var string
     */
    private $userAgent;

    /**
     * @var array
     */
    private $additionalData;


    /**
     * Constructor
     */
    function __construct()
    {
        $this->bankCode = '';
        $this->bankInterface = '';
        $this->returnURL = '';
        $this->reference = '';
        $this->description = '';
        $this->language = '';
        $this->currency = '';
        $this->totalAmount = 0;
        $this->taxAmount = 0;
        $this->devolutionBase = 0;
        $this->tipAmount = 0;
        $this->ipAddress = (new RemoteAddress())->getIpAddress();
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
        $this->additionalData = [];

        $this->payer = new Person();
        $this->buyer = new Person();
        $this->shipping = new Person();
    }

    /**
     * Fill the current object instance
     *
     * @param array $data
     * @return $this
     */
    public function fill(Array $data)
    {
        foreach ($data as $key => $value) {
            if (!isset($this->{$key})) {
                continue;
            }

            if (in_array($key, ['payer', 'buyer', 'shipping'])) {
                $this->{$key}->fill($value);
                continue;
            }

            $this->{$key} = $value;
        }

        return $this;
    }

    /**
     * Convert to array the datas
     * @return array
     */
    public function toArray()
    {
        $payer = !$this->payer->isEmpty() ? $this->payer->toArray() : [];
        $buyer = !$this->buyer->isEmpty() ? $this->buyer->toArray() : [];
        $shipping = !$this->shipping->isEmpty() ? $this->shipping->toArray() : [];

        return [
            'bankCode' => $this->bankCode,
            'bankInterface' => $this->bankInterface,
            'returnURL' => $this->returnURL,
            'reference' => $this->reference,
            'description' => $this->description,
            'language' => $this->language,
            'currency' => $this->currency,
            'totalAmount' => $this->totalAmount,
            'taxAmount' => $this->taxAmount,
            'devolutionBase' => $this->devolutionBase,
            'tipAmount' => $this->tipAmount,
            'payer' => $payer,
            'buyer' => $buyer,
            'shipping' => $shipping,
            'ipAddress' => $this->ipAddress,
            'userAgent' => $this->userAgent,
            'additionalData' => $this->additionalData
        ];
    }
}