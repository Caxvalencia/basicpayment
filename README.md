# Basicpayment
A basic payment client with a webservice of PlaceToPlay company

## Installing
For install, run command-line your composer with:

```php
composer require testplacetopay/basicpayment
```

## Getting started
Create a new instance of BasicPayment of the namespace 'TestPlaceToPay\BasicPayment\' and add configuraction parameters

```php
$basicPayment = new TestPlaceToPay\BasicPayment\BasicPayment([
	'DEF_SERVICE'	=> "https://test.placetopay.com/soap/pse/?wsdl",
	'CACHE_FOLDER'	=> dirname( __FILE__ ) . '/tmp',
	'LOGIN'			=> '---LOGIN---',
	'TRANKEY'		=> '--TRANKEY--'
]);
```

*Default values for the config parameters*
```php
[
	'DEF_SERVICE'			=> 'https://test.placetopay.com/soap/pse/?wsdl',
	'CACHE_DRIVER'			=> '\Doctrine\Common\Cache\FilesystemCache',
	'CACHE_FOLDER'			=> './tmp',
	'BANK_LIST_TIME_LIFE'	=> 60 * 60 * 24,
	'LOGIN'					=> '',
	'TRANKEY'				=> ''
];
```

## Methods
* $basicPayment->createTransaction( $req )
* $basicPayment->getTransactionInformation( $transactionID )
* $basicPayment->getBankList()
* $basicPayment->getDatas()
* $basicPayment->getError()
