<?php 

namespace model\NumeralConventer;

interface Engine {
	
	public function convert( $number );
	
	public function isValid( $number );
	
}