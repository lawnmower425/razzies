<?php

session_start();
ini_set('default_charset', 'UTF-8');

use \framework\HTTP\Request\IncomingRequest;
use \framework\HTTP\Request\IncomingRequestCollection;

require_once __DIR__.'/../Initializer.class.php';

Initializer::create()
	->initialize('classes/', '', __DIR__.'/framework');

/**
 *
 * The asynchronous file as a gate to the controllers and their functions
 * @author René Herzog
 */
Framework::initialize(); //loads dbEntity, Controller, the basic stuff...
if (!isset($_GET['c']) && !isset($_GET['multi_call'])) { die('Fehler'); }

if (isset($_GET['multi_call']) && ($_GET['multi_call'] == '1')) {

	die(IncomingRequestCollection::create($_POST, $_GET)->processRequest());
} else {

	die(IncomingRequest::create($_POST, $_GET)->processRequest());
}