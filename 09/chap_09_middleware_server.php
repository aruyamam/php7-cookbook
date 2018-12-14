<?php
require __DIR__ .'/../Application/Autoload/Loader.php';

Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\MiddleWare\ServerRequest;

$request = new ServerRequest();
$request->initialize();

echo '<pre>', var_dump($request), '</pre>';
