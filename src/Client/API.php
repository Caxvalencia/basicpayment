<?php

namespace TestPlaceToPay\BasicPayment\Client;

use SoapClient;
use TestPlaceToPay\BasicPayment\Client\Models\Authentication;
use TestPlaceToPay\BasicPayment\Client\Models\PSETransactionResponse;
use TestPlaceToPay\BasicPayment\Config;
use TestPlaceToPay\BasicPayment\Client\Models\TransactionInformation;

/**
 * API
 */
class API
{
    const BANK_LIST = 'BANK_LIST';

    /**
     * @var array
     */
    private $error;

    /**
     * @var API
     */
    private static $instance = null;

    /**
     * @var Cache
     */
    private $cache = null;

    /**
     * @var Authentication
     */
    private $auth = null;

    /**
     * @var \SoapClient
     */
    private $soapClient = null;


    public function __clone()
    {
        trigger_error('CLONING_IS_NOT_ALLOWED', E_USER_ERROR);
    }

    /**
     * API constructor.
     */
    private function __construct()
    {
        $cacheDriver = Config::get('CACHE_DRIVER');
        $this->cache = new $cacheDriver(Config::get('CACHE_FOLDER'));
        $this->auth = new Authentication(Config::get('LOGIN'), Config::get('TRANKEY'));

        $this->soapClient = new SoapClient(Config::get('DEF_SERVICE'), [
            'trace' => true,
            'exceptions' => true
        ]);
    }

    /**
     * Return one unique instance
     * @return API
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $_class = __CLASS__;
            self::$instance = new $_class;
        }

        return self::$instance;
    }

    /**
     * Return bank list
     * @return array|mixed
     */
    public function getBankList()
    {
        if ($this->cache->contains(self::BANK_LIST)) {
            return $this->cache->fetch(self::BANK_LIST);
        }

        $res = $this->watchRequest(function () {
            $data = $this->soapClient->getBankList(['auth' => $this->auth->toArray()]);
            $this->cache->save(self::BANK_LIST, $data, Config::get('BANK_LIST_TIME_LIFE'));

            return $data;
        });

        return $res;
    }

    /**
     * Create new transaction
     * @param array $params
     * @return PSETransactionResponse|mixed
     */
    public function createTransaction(Array $params)
    {
        $res = $this->watchRequest(function () use ($params) {
            return $this->soapClient->createTransaction([
                'auth' => $this->auth->toArray(),
                'transaction' => $params
            ]);
        });

        return $res;
    }

    /**
     * Create new transaction multi-credit
     *
     * @param array $params
     * @return PSETransactionResponse|null
     */
    public function createTransactionMultiCredit(Array $params)
    {
        $res = $this->watchRequest(function () use ($params) {
            return $this->soapClient->createTransaction([
                'auth' => $this->auth->toArray(),
                'transaction' => $params
            ]);
        });

        return $res;
    }

    /**
     * Return info of a transaction
     * @param int $transactionID
     * @return TransactionInformation|mixed
     */
    public function getTransactionInformation($transactionID)
    {
        $res = $this->watchRequest(function () use ($transactionID) {
            return $this->soapClient->getTransactionInformation([
                'auth' => $this->auth->toArray(),
                'transactionID' => $transactionID
            ]);
        });

        return $res;
    }

    /**
     * Control of exceptions for request
     *
     * @param \Closure $req
     * @return mixed|null
     */
    private function watchRequest($req)
    {
        try {
            return $req->call($this);

        } catch (\SoapFault $exp) {
            $this->error = [
                'message' => $exp->faultstring,
                'code' => $exp->faultcode,
                'trace' => $exp->getTraceAsString()
            ];
        }

        return null;
    }

    /**
     * Return description or array data with the error of the request
     *
     * @param string|null $key
     * @return string|array
     */
    public function getError($key = null)
    {
        if ($key) {
            return $this->error[$key];
        }

        return $this->error;
    }
}