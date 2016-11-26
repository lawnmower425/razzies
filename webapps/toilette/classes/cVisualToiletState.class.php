<?php namespace Toilette;

use \Controller;
use \framework\HTTP\Response\Response;
use \framework\HTTP\Response\ResponseDataInsertContent;

/**
 * Delivers the visual state of the toilet with a div and stuff
 *
 * @author René Herzog <r.herzog@wekando.de>
 */
class cVisualToiletState extends Controller {

	/**
	 * The main function
	 * @return string
	 */
	public function syncHandle() {

		return Response::create()
			->addResponseData(
				ResponseDataInsertContent::create(
					'stateDiv', 'hallo'
				)
		);
	}
}
