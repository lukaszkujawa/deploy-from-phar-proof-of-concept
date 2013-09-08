<?php

namespace model;

class NumeralConventer {
	
	static function convert( $number, \model\NumeralConventer\Engine $engine ) {
		if( ! $engine->isValid( $number ) ) {
			throw new \model\NumeralConventer\EngineException(
							\model\NumeralConventer\EngineException::INCORRECT_NUMBER );			
		}
		
		return $engine->convert( $number );
	}
	
}