<?php

use \Razzwork\Autoloader as RazzAutoloader;

require_once __DIR__.'/../Razzwork/Autoloader.class.php';

/**
 * Initializes autoloaders, Razzwork and everything else needed for webapps of us
 *
 * @author René Herzog <lawnmower at arcor dot de>
 */
class Initializer {

	/**
	 * Static creator
	 * @return \self
	 */
	public static function create() {

		return new self();
	}

	/**
	 * Initializes all autoloaders, db connection etc for the whole system
	 */
	public function initialize($sControllers, $sModels, $sFrameworkPath) {

		RazzAutoloader::register();

		$this
			->initializeFramework($sControllers, $sModels, $sFrameworkPath);

	}

	/**
	 * Load all framework components and make it run correctly
	 * @return \scholztiming\Init\InitializerBasis
	 */
	public function initializeFramework($sControllers, $sModels, $sFrameworkPath) {

		require_once __DIR__.'/framework/classes/Framework.class.php';
		\Framework::setControllerPath($sControllers);
		//Framework::setModelPath($sModels);
		\Framework::setFrameworkPath($sFrameworkPath);
		\Framework::initialize();

		return $this;
	}
}
