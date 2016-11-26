<?php

ini_set('display_erros', 'on');
ini_set('error_reporting', E_ALL);

require_once __DIR__.'/../../Razzwork/Autoloader.class.php';

Razzwork\Autoloader::register();

$oPin = new \Razzwork\GPIO\Pin(23, 'in');

var_dump($oPin->getDirection());
var_dump($oPin->getValue());
