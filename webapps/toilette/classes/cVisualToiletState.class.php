<?php

use \framework\html\htmlDiv;
use \framework\html\htmlSource;
use \framework\HTTP\Response\Response;
use \framework\HTTP\Response\ResponseDataInsertContent;
use \Razzwork\Drivers\PCF8591;

/**
 * Delivers the visual state of the toilet with a div and stuff
 *
 * @author René Herzog <r.herzog@wekando.de>
 */
class cVisualToiletState extends Controller {

	/**
	 * The threshold between on and off - greater values mean the light is off
	 */
	const THRESHOLD = 130;

	/**
	 * The main function
	 * @return string
	 */
	public function syncHandle() {

		$oPcf = PCF8591::create();
		//we have to read 2 bytes because the ADC of the PCF always delivers
		//the last measured value first, to allow differencial AD-Conversion
		$iLightValue = $oPcf->readByte(PCF8591::AIN0);
		$iLightValue = $oPcf->readByte(PCF8591::AIN0);

		$sClass = '';

		if ($iLightValue > self::THRESHOLD) {

			$sClass = 'lightson';
			$sText	= 'FREI';
		} else {

			$sClass = 'lightsoff';
			$sText	= 'BESETZT';
		}

		return Response::create()
			->addResponseData(
				ResponseDataInsertContent::create(
					'stateDiv',
					htmlDiv::create()
						->addCssClass('stateResultDiv')
						->addCssClass($sClass)
						->addComponent(

							htmlSource::create($sText)
						)
				)
		);
	}
}
