<?php

namespace TestPlaceToPay\BasicPayment\Client\Models;

/**
 * Class Authentication
 * @package TestPlaceToPay\BasicPayment\Client\Models
 */
class Authentication
{
    private $login;
    private $tranKey;
    private $tranKeyInit;
    private $seed;
    private $additional;

    function __construct($login, $tranKey)
    {
        $this->login = $login;
        $this->tranKeyInit = $tranKey;
        $this->additional = [];

        $this->refresh();
    }

    /**
     * Refresh seed and tranKey
     * @return Authentication object
     */
    public function refresh()
    {
        $this->seed = date('c');
        $this->tranKey = sha1($this->seed . $this->tranKeyInit, false);

        return $this;
    }

    /**
     * Return array with the datas of the auth
     * @return array
     */
    public function toArray()
    {
        return [
            'login' => $this->login,
            'tranKey' => $this->tranKey,
            'seed' => $this->seed,
            'additional' => $this->additional
        ];
    }
}