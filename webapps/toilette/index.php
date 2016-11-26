<?php

use \Razzwork\Autoloader as RazzAutoloader;
use \Razzwork\Drivers\PCF8591;

ini_set('display_erros', 'on');
ini_set('error_reporting', E_ALL);

require_once __DIR__.'/../../Razzwork/Autoloader.class.php';

RazzAutoloader::register();

require_once __DIR__.'/../framework/classes/Framework.class.php';

\Framework::setControllerPath(__DIR__.'/../');
\Framework::setModelPath(__DIR__.'/../');
\Framework::setFrameworkPath(__DIR__.'/../../framework/');
\Framework::initialize();


$oPfc = new PCF8591();
echo $oPfc->readByte(PCF8591::AIN0);

/*if ($oPfc->readByte(PCF8591::AIN0) < 100)
	echo 'Toilette besetzt'; else echo 'Toilette offen';*/

die(fgettemplate(
	__DIR__.'/index.html',
		array(
			'FRAMEWORK_JS'	=>
				\Framework::loadFrameworkJs(
					'FRAMEWORK_MAIN',
					'',
					__DIR__.'/../')
		)
	)
);