<?php

use \Razzwork\Autoloader;
use \Razzwork\Drivers\I2CBus;
use \Razzwork\GPIO\Pin;

ini_set('display_erros', 'on');
ini_set('error_reporting', E_ALL);

require_once __DIR__.'/../../Razzwork/Autoloader.class.php';

Autoloader::register();

$oPin = new Pin(23, 'in');
$oI2C = new I2CBus("0x48");

var_dump($oPin->getDirection());
var_dump($oPin->getValue());
var_dump($oI2C->read_register(""));
