<?php 

namespace model\NumeralConventer;

class EngineException extends \Exception {
	
	const INCORRECT_NUMBER = 1;
	
	private $messages = array(
		self::INCORRECT_NUMBER => 'Incorrect number',
	);
	
	public function __construct( $code ) {
		if( isset( $this->messages[ $code ] ) ) {
			$message = $this->messages[ $code ];
		}
		else {
			$message = 'Undefined error';
		}
		
		parent::__construct( $message, $code );
	}
}