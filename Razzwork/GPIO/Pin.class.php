<?php namespace Razzwork\GPIO;

/**
* Represents a pin on the raspberry
* @author René lawnmower at arcor dot de
*/
class Pin {

	/**
	 * Directory for reading and writing from and to the pins
	 */
	const PINDIR = '/sys/class/gpio';

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
	public function __construct($iPinNumber, $sDirection) {

		//store the pin number
		$this->iPinNumber = $iPinNumber;
		//export this pin, if it is not there yet
		if (!file_exists(self::PINDIR.'/gpio'.$iPinNumber)) {

			file_put_contents(
				self::PINDIR.'/export',
				$this->iPinNumber
			);
		}

		//set up the direction
		file_put_contents(
			self::PINDIR.'/gpio'.$this->iPinNumber.'/direction',
			$sDirection
		);
	}

	/**
	 * Set the direction - you usually do this already in the constructor
	 * but it -may- be that you wanna change it
	 * @param string $sDirection
	 * @return Pin
	 */
	public function setDirection($sDirection) {

		//set up the direction
		file_put_contents(
			self::PINDIR.'/gpio'.$this->iPinNumber.'/direction',
			$sDirection
		);
		return $this;
	}

	/**
	 * Get the direction of the pin
	 * @return string in|out
	 */
	public function getDirection() {

		return file_get_contents(
			self::PINDIR.'/gpio'.$this->iPinNumber.'/direction'
		);
	}

	/**
	 * Read from the pin
	 * @return int
	 */
	public function getValue() {

		return trim(
			file_get_contents(
				self::PINDIR.'/gpio'.$this->iPinNumber.'/value'
			)
		);
	}
}
