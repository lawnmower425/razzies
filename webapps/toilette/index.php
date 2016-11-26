<?php

use \Razzwork\Autoloader;
use \Razzwork\Drivers\I2CBus;
use \Razzwork\Drivers\PCF8591;
use \Razzwork\GPIO\Pin;

ini_set('display_erros', 'on');
ini_set('error_reporting', E_ALL);

require_once __DIR__.'/../../Razzwork/Autoloader.class.php';

Autoloader::register();

$oPin = new Pin(23, 'in');
$oI2C = new I2CBus("0x48");

var_dump($oPin->getDirection());
var_dump($oPin->getValue());

$oPfc = new PCF8591();
if ($oPfc->readByte(PCF8591::AIN0) < 100)
	echo 'Toilette besetzt'; else echo 'Toilette offen';
