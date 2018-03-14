# Basicpayment
A basic payment client with a webservice of PlaceToPlay company

## Installing
For install:

```php
composer require testplacetopay/basicpayment
```

## Getting started
Create a new instance of BasicPayment of the namespace 'TestPlaceToPay\BasicPayment\' and add configuraction parameters

```php
$basicPayment = new TestPlaceToPay\BasicPayment\BasicPayment([
    'DEF_SERVICE' => "https://test.placetopay.com/soap/pse/?wsdl",
    'CACHE_FOLDER' => dirname( __FILE__ ) . '/tmp',
    'LOGIN' => '---LOGIN---',
    'TRANKEY' => '--TRANKEY--'
]);
```

*Default values for the config parameters*
```php
[
    'BANK_LIST_TIME_LIFE' => 60 * 60 * 24,
    'DEF_SERVICE' => 'https://test.placetopay.com/soap/pse/?wsdl',
    'CACHE_DRIVER' => '\Doctrine\Common\Cache\FilesystemCache',
    'CACHE_FOLDER' => './tmp',
    'LOGIN' => '',
    'TRANKEY' => ''
];
```

## Methods
```php
$basicPayment->createTransaction( $req )
$basicPayment->getTransactionInformation( $transactionID )
$basicPayment->getBankList()
$basicPayment->getDatas()
$basicPayment->getError()
```
