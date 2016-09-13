<?php
namespace TestPlaceToPay\BasicPayment\Client\Models;

/**
 * Person
 */
class Person {
	/**
	 * @var string
	 */
	private $documentType;

	/**
	 * @var string
	 */
	private $document;

	/**
	 * @var string
	 */
	private $firstName;

	/**
	 * @var string
	 */
	private $lastName;

	/**
	 * @var string
	 */
	private $company;

	/**
	 * @var string
	 */
	private $emailAddress;

	/**
	 * @var string
	 */
	private $address;

	/**
	 * @var string
	 */
	private $city;

	/**
	 * @var string
	 */
	private $province;

	/**
	 * @var string
	 */
	private $country;

	/**
	 * @var string
	 */
	private $phone;

	/**
	 * @var string
	 */
	private $mobile;
	

	function __construct() {
		$this->documentType = '';
		$this->document = '';
		$this->firstName = '';
		$this->lastName = '';
		$this->company = '';
		$this->emailAddress = '';
		$this->address = '';
		$this->city = '';
		$this->province = '';
		$this->country = '';
		$this->phone = '';
		$this->mobile = '';
	}

	/**
	 * Fill the current object instance
	 * @param Array $datas 
	 * @return $this
	 */
	public function fill( $datas ) {
		foreach( $datas as $key => $value ) {
			if( !isset( $this->{ $key } ) ) continue;
			$this->{ $key } = $value;
		}

		return $this;
	}

	/**
	 * Information for tester
	 * @return Array
	 */
	public function test() {
		return [
			'documentType'	=> 'CC',
			'document'		=> '123456789',
			'firstName'		=> 'Dark Pepe',
			'lastName'		=> 'Tester',
			'company'		=> 'Darkside S.A.S.',
			'emailAddress'	=> 'darkpepe@test.co',
			'address'		=> 'cll not found',
			'city'			=> 'Medellin',
			'province'		=> 'Antioquia',
			'country'		=> 'CO',
			'phone'			=> '1234567',
			'mobile'		=> '1234567890'
		];
	}

	/**
	 * Convert to array the datas
	 * @return Array
	 */
	public function toArray() {
		return [
			'documentType'	=> $this->documentType,
			'document'		=> $this->document,
			'firstName'		=> $this->firstName,
			'lastName'		=> $this->lastName,
			'company'		=> $this->company,
			'emailAddress'	=> $this->emailAddress,
			'address'		=> $this->address,
			'city'			=> $this->city,
			'province'		=> $this->province,
			'country'		=> $this->country,
			'phone'			=> $this->phone,
			'mobile'		=> $this->mobile
		];
	}

	public function isEmpty() {
		return empty( $this->firstName ) && empty( $this->lastName );
	}
}