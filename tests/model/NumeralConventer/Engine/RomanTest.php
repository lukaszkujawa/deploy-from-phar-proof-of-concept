<?php 

/**
 * This should be handle by autoloader
 */
require APPLICATION_PATH . '/model/NumeralConventer/Engine.php';
require APPLICATION_PATH . '/model/NumeralConventer/Engine/Roman.php';

class RomanTest extends PHPUnit_Framework_TestCase {
	
	private $romanConventer;
	
	public function setUp() {
		$this->romanConventer = new \model\NumeralConventer\Engine\Roman();
	}
	
	public function providerValidation() {
		return array(
			array( 1, true ),
			array( 0, false ),
			array( -1, false ),
			array( 3999, true ),
			array( 4000, false ),
		);
	}
	
	/**
	 * @dataProvider providerValidation
	 */
	public function testValidation( $input, $expected ) {
		$this->assertEquals( $this->romanConventer->isValid( $input ), $expected );
	}
	
	public function providerConversion() {
		return array(
			array( 1, 'I' ),
			array( 5, 'V' ),
			array( 4, 'IV' ),
			array( 6, 'VI' ),
			array( 9, 'IX' ),
			array( 10, 'X' ),
			array( 202, 'CCII' ),
			array( 3210, 'MMMCCX' ),
		);
	}
	
	/**
	 * @dataProvider providerConversion
	 */
	public function testConversion( $input, $output ) {
		$this->assertEquals( $this->romanConventer->convert( $input ), $output );
	}
	
}