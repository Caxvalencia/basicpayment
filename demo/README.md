# Demo
For install:

```php
composer install
```

Add in the configuration data authentication

```php
$basicPayment = new TestPlaceToPay\BasicPayment\BasicPayment([
	'DEF_SERVICE'	=> "https://test.placetopay.com/soap/pse/?wsdl",
	'CACHE_FOLDER'	=> dirname( __FILE__ ) . '/tmp',
	'LOGIN'			=> '---LOGIN---', // Here
	'TRANKEY'		=> '--TRANKEY--' // And here
]);
```
