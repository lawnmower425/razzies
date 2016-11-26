<?php

/**
* Represents a pin on the raspberry
* @author René lawnmower at arcor dot de
*/
class Pin {

	/**
	 * Directory for reading and writing from and to the pins
	 */
	const PINDIR = '/sys/class/gpio/gpio';

	const DIRECTION_OUT = 'out';
	const DIRECTION_IN	= 'in';

	/**
	 * The number for this pin
	 * @var int
	 */
	protected $iPinNumber;

	/**
	 * Constructor
	 * @param int $iPinNumber Specifies the number (according to your mode)
	 */
	public function __construct($iPinNumber, $iDirection) {

		//store the pin number
		$this->iPinNumber = $iPinNumber;
		//set up the direction
		file_put_contents(
			self::PINDIR.$this->iPinNumber.'/direction',
			$iDirection
		);
	}

	/**
	 * Read from the pin
	 * @return int
	 */
	public function read() {

		return trim(
			file_get_contents(
				self::PINDIR.$this->iPinNumber.'/direction'
			)
		);
	}
}
