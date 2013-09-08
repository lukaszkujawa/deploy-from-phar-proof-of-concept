<?php 

namespace model\NumeralConventer\Engine;

class Roman implements \model\NumeralConventer\Engine {
	
	private $numbers =  array( 1000, 900, 500, 400, 100,90, 50, 40, 10, 9, 5, 4, 1 );
	private $numerals = array( 'M', 'CM', 'D', 'CD', 'C', 'XC', 'L', 'XL', 'X', 'IX', 'V', 'IV', 'I' );
	
	public function convert( $input ) {
		$ret = '';
		
		for ( $i = 0; $i < 13; $i++) {
			while ( $input >= $this->numbers[ $i ] ) {
				$input -= $this->numbers[$i];
				$ret .= $this->numerals[$i];
			}
		}
		
		return $ret;
	}
	
	public function isValid( $number ) {
		return preg_match('/[1-9][0-9]*/', $number ) && 
				$number < 4000 &&
				$number > 0;
	}
	
}