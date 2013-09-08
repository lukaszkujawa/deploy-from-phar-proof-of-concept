<?php

defined('APPLICATION_PATH')
|| define('APPLICATION_PATH', 'phar://' . realpath( dirname(__FILE__) . '/../demo.phar') . '/application');

require APPLICATION_PATH . '/bootstrap.php';

/**
 * Controller
 */

if( isset( $_POST['number'] ) ) {
	
	try {
		$roman = \model\NumeralConventer::convert(
				$_POST['number'], new \model\NumeralConventer\Engine\Roman() );
	}
	catch( \model\NumeralConventer\EngineException $e ) {
		$roman = sprintf( "Conversion error \"%s\"", $e->getMessage() );
	}
	
}

/**
 * View
 */
	
if( isset( $roman ) ) {
	printf( "<h1>Number after conversion: %s</h1>", $roman );
}

?>
<form method="post" action="/">
	<input type="text" placeholder="number to convert" name="number" />
	<input type="Submit" value="Convert" />
</form>