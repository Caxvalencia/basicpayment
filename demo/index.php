<?php
require "../vendor/autoload.php";

$basicPayment = new TestPlaceToPay\BasicPayment\BasicPayment([
	'DEF_SERVICE'	=> "https://test.placetopay.com/soap/pse/?wsdl",
	'CACHE_FOLDER'	=> dirname( __FILE__ ) . '/tmp',
	'LOGIN'			=> '',
	'TRANKEY'		=> ''
]);

if( isset( $_POST[ 'page' ] ) && $_POST[ 'page' ] === 'callback' ) {
	// call getTransactionInformation with ID
	print_r( $_POST );
}


if( isset( $_POST[ 'action' ] ) && $_POST[ 'action' ] === 'create_transaction' ) {
	$res = $basicPayment->createTransaction( array_merge([
		'returnURL'		=> 'http://' . $_SERVER[ 'HTTP_HOST' ] . '/?page=callback', // Pagina de aterrizaje
		'reference'		=> 'REF_CODE_TEST',
		'language'		=> 'ES',
		'totalAmount'	=> 20000,
		'taxAmount'		=> 1500,
		'devolutionBase'=> 500,
		'tipAmount'		=> 0,
		// 'buyer'			=> ( new \TestPlaceToPay\BasicPayment\Client\Models\Person() )->test(),
		'shipping'		=> ( new \TestPlaceToPay\BasicPayment\Client\Models\Person() )->test()
	], $_POST ) );

	if( $res->returnCode === 'SUCCESS' ) {
		// To do thing before exit
		header( 'Location: ' . $res->bankUrl );
		exit();
	}
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8" />
	<title>Demo - BasicPayment</title>

	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
</head>

<body>

	<?= $basicPayment->renderForm( dirname( __FILE__ ) . '/transaction-form.php', [
		'error'	=> $basicPayment->getError(),
		'payer' => ( new \TestPlaceToPay\BasicPayment\Client\Models\Person() )->test()
	]); ?>
	
	<!-- ALTERNATIVA CON BLADE TEMPLATE DENTRO DE LARAVEL -->
	<!-- view( 'transaction_form_path', $basicPayment->getDatas() ) -->
	
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>

	<script>
		$( document ).ready( function() {
			Materialize.updateTextFields();
			$( 'select' ).material_select();
		});
	</script>
</body>
</html>