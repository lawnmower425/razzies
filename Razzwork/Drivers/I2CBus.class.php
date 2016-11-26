<?php namespace Razzwork\Drivers;

/**
 * Use the i2c-bus of razzi to communicate with multiple devices
 * It is a quite slow implementation using shell_exec and therefore may get
 * timing issues on fast data transmissions
 *
 * In that case, a c-program or a corresponding php extension would be more
 * feasible
 *
 * @author René Herzog <lawnmower at arcor dot de>
 */
class I2CBus {

	/**
	 * the i2c block ( 0 on first gen rpi's, 1 on subsequnet rpi's )
	 * @var int
	 */
	protected $block = 1;

	/**
	 * The I2C Bus address to communicate with
	 * @var string
	 */
	protected $sAddress;

	/**
	 * Constructor
	 * @param string $sAddress The i2c address to communicate with
	 */
	public function __construct($sAddress) {

		$this->sAddress = $sAddress;
	}

	/**
	 * Read from a register
	 * @param string $sRegister The location of the register (e.g. 0x29)
	 * @return string
	 */
	public function read_register($sRegister) {

		return trim(
			shell_exec(
				'i2cget -y ' . $this->block . ' ' . $this->sAddress . ' ' . $sRegister
			)
		);
	}

	/**
	 * Read a signed short value from the i2c
	 *
	 * @param string $msb_register most significant byte register location
	 * @return int
	 */
	public function read_signed_short($msb_register) {

		$msb = intval( $this->read_register( $msb_register ), 16 );
		$lsb = intval( $this->read_register( $msb_register + 1 ), 16 );
		$val = ( $msb << 8 ) + $lsb;
		$array = unpack( 's', pack( 'v', $val ) );
		$decimal_value = $array[1];
		return $decimal_value;
	}

	/**
	 * Read an unsigned short from the register
	 * @param string $msb_register The most significiant byte register
	 * @return int
	 */
	public function read_unsigned_short(
		$msb_register	// most significant byte register location
	) {
		$msb = intval( $this->read_register( $msb_register ), 16 );
		$lsb = intval( $this->read_register( $msb_register + 1 ), 16 );
		$val = ( $msb << 8 ) + $lsb;
		$array = unpack( 'S', pack( 'v', $val ) );
		$decimal_value = $array[1];
		return $decimal_value;
	}

	/**
	 * Read a long value from the bus in a register
	 * @param string $msb_register Most significiant byte register
	 * @return int (long value)
	 */
	public function read_unsigned_long($msb_register) {

		$msb = intval( $this->read_register( $msb_register ), 16 );
		$lsb = intval( $this->read_register( $msb_register + 1 ), 16 );
		$xlsb = intval( $this->read_register( $msb_register + 2 ), 16 );
		$val = ( $msb << 16 ) + ( $lsb << 8 ) + $xlsb;
		$array = unpack( 'l', pack( 'V', $val ) );
		$decimal_value = $array[1];
		return $decimal_value;
	}

	/**
	 * Write a value to a register
	 * @param string $register e.g. 0x29
	 * @param string $value MUST be decimal value (0100010 must be passed as ???
	 */
	public function write_register($register, $value) {

		shell_exec(
			'i2cset -y ' . $this->block . ' ' . $this->i2c_address . ' ' . $register . ' ' . $value
		);
	}
}