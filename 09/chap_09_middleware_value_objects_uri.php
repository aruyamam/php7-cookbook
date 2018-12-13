<?php
require __DIR__ . '/../Application/Autoload/Loader.php';

Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\MiddleWare\Uri;

$uri = new Uri();
$uri->withScheme('https')
    ->withHost('localhost')
    ->withPort('8080')
    ->withPath('chap_09_middleware_value_objects_uri.php')
    ->withQuery('param=TEST');

echo $uri;
