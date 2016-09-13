<?php
namespace TestPlaceToPay\BasicPayment;

/**
 * Config
 */
abstract class Config {
	
	private static $config = [
		'DEF_SERVICE'			=> 'https://test.placetopay.com/soap/pse/?wsdl',
		'CACHE_DRIVER'			=> '\Doctrine\Common\Cache\FilesystemCache',
		'CACHE_FOLDER'			=> './tmp',
		'BANK_LIST_TIME_LIFE'	=> 60 * 60 * 24,
		'LOGIN'					=> '',
		'TRANKEY'				=> ''
	];

	public static function get( $key ) {
		return self::$config[ $key ];
	}

	public static function set( $key, $value = null ) {
		if( !isset( self::$config[ $key ] ) )
			return false;

		self::$config[ $key ] = $value;
		return true;
	}

	public static function all( $config = null ) {
		if( $config === null )
			return self::$config;

		self::$config = array_merge( self::$config, $config );
	}
}