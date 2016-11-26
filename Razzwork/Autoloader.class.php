<?php namespace Razzwork;

/**
 * The main autoloader for Razzwork, being compatible with other autoloaders
 *
 * @author René Herzog
 */
class Autoloader {

	/**
	 * Requires the given class
	 * @param string $sClass
	 * @return bool
	 */
	public static function loadClass($sClass) {

		//exclude framework classes - why am i called on framework classes ?!?!?
		if (!preg_match('/^Razzwork\\\/i', $sClass)) { return false; }

		$sFile = __DIR__.'/'.str_replace('\\', '/', preg_replace('/^Razzwork\\\/i', '', $sClass)).'.class.php';

		if (file_exists($sFile))
			//require is *bit* faster than require_once
			require $sFile;
		else
			throw new \Exception(
				'require_once() [function.require]: Failed opening required \''.$sFile.'\''
			);
		return true;
	}

	/**
	 * Registers the autoloader
	 * @return void
	 */
	public static function register() {

		spl_autoload_register(__NAMESPACE__.'\\Autoloader::loadClass');
	}
}