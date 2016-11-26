<?php

use \Razzwork\Drivers\PCF8591;

require_once __DIR__.'/../Initializer.class.php';

//initialize everything using our framework
Initializer::create()
	->initialize('', '', __DIR__.'/framework');

$oPfc = new PCF8591();
//echo $oPfc->readByte(PCF8591::AIN0);

/*if ($oPfc->readByte(PCF8591::AIN0) < 100)
	echo 'Toilette besetzt'; else echo 'Toilette offen';*/

die(fgettemplate(
	'index.html',
		array(
			'FRAMEWORK_JS'	=>
				\Framework::loadFrameworkJs(
					'FRAMEWORK_MAIN',
					'',
					'toilette/'
				)
		)
	)
);