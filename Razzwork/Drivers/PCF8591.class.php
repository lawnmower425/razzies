<?php namespace Razzwork\Drivers;

/**
 * A class to communicate with the pcf8591 analog digital converter chip via
 * I2C on raspberry pi
 * Currently, the class assumes the pcf to be connected on the default i2c
 * pins of the razzie
 *
 * @author René Herzog <lawnmower at arcor dot de>
 */
class PCF8591 {

	CONST AIN0			= "0x40";
	CONST AIN1			= "0x41";
	CONST AIN2			= "0x42";
	CONST AIN3			= "0x43";

	/**
	 * CTor
	 */
	public function __construct() {

	}

	/**
	 * Read a single byte from one
	 * @param string $sAINPin 0x40..43 or one of the constants ::AIN0..3
	 */
	public function readByte($sAINPin) {

		$oI2C = new I2CBus("0x48");
		//tell the adc which address to read from 0x40 = 0, 0x41 = 1 etc. 3 is max
		$oI2C->write_register("0x48", $sAINPin);
		//read the value as result
		return hexdec($oI2C->read_register(""));
	}
}