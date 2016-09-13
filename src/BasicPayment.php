<?php
namespace TestPlaceToPay\BasicPayment;

use TestPlaceToPay\BasicPayment\Client\API;
use TestPlaceToPay\BasicPayment\Client\Models\PSETransaction;
use TestPlaceToPay\BasicPayment\Config;
use TestPlaceToPay\BasicPayment\Datas\CurrencyList;
use TestPlaceToPay\BasicPayment\Datas\DocumentTypes;
use TestPlaceToPay\BasicPayment\Datas\CountryList;

/**
 * Class BasicPayment
 */
class BasicPayment {
	/**
	 * @var API
	 */
	protected $api = null;

	/**
	 * @var string
	 */
	private $error;


	/**
	 * Constructor
	 * @param array $config 
	 * @return $this
	 */
	function __construct( $config ) {
		$this->error = '';
		Config::all( $config );
		$this->api = API::getInstance();
	}

	/**
	 * Create a transaction via api
	 * @param array $req 
	 * @return object|boolean
	 */
	public function createTransaction( $req ) {
		$transaction = new PSETransaction();
		$res = $this->api->createTransaction( $transaction->fill( $req )->toArray() );

		if( !$res ) {
			$this->error = sprintf( 'Ocurrio un problema al crear la transacción, "%s"', $this->api->getError( 'message' ) );
			return false;
		}

		if( $res->createTransactionResult->returnCode !== 'SUCCESS' ) {
			$this->error = sprintf( 'Ocurrio un problema al crear la transacción, "%s"', $res->createTransactionResult->responseReasonText );
		}
		
		return $res->createTransactionResult;
	}

	/**
	 * Description
	 * @param type $transactionID 
	 * @return type
	 */
	public function getTransactionInformation( $transactionID ) {
		$res = $this->api->getTransactionInformation( $transactionID );

		if( !$res ) {
			$this->error = sprintf( 'Ocurrio un problema al consultar la transacción, "%s"', $this->api->getError( 'message' ) );
			return false;
		}
		
		return $res->getTransactionInformationResult;
	}
	
	/**
	 * Render a partial view
	 * @param string $includePath 
	 * @param type|array $datas 
	 * @return type
	 */
	public function renderForm( $includePath, $datas = [] ) {
		extract( $this->getDatas() );
		extract( $datas );
		require_once( $includePath );
	}

	/**
	 * Return a bank list via api
	 * @return array|string
	 */
	public function getBankList() {
		$bankList = $this->api->getBankList();

		if( !$bankList ) {
			$this->error = 'No se pudo obtener la lista de Entidades Financieras, por favor intente más tarde';
			return false;
		}

		return $bankList->getBankListResult->item;
	}

	/**
	 * Datas for form views
	 * @return array
	 */
	public function getDatas() {
		return [
			'bankList' 		=> $this->getBankList(),
			'currencyList'	=> CurrencyList::get(),
			'documentTypes'	=> DocumentTypes::get(),
			'countryList'	=> CountryList::get()
		];
	}

	/**
	 * Return description of the error request
	 * @return string
	 */
	public function getError() {
		return $this->error;
	}
}