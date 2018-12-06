<?php
define('DEFAULT_ORIGIN', 'New York City');
define('DEFAULT_DESTINATION', 'Redondo Beach');
define('DEFAULT_FORMAT', 'json');
$apiKey = include __DIR__ . '/../config/google_api_key.php';

require __DIR__ . '/../Application/Autoload/Loader.php';

// add current directory to the path
Application\Autoload\Loader::init(__DIR__ . '/..');

// anchor classes
use Application\Web\Request;
use Application\Web\Client\Curl;

// get start and end
$start = $_GET['start'] ?? DEFAULT_ORIGIN;
$end   = $_GET['end'] ?? DEFAULT_DESTINATION;
$start = strip_tags($start);
$end   = strip_tags($end);

$request = new Request(
   'https://maps.googleapis.com/maps/api/directions/json',
   Request::METHOD_GET,
   NULL,
   [
      'origin'      => $start,
      'destination' => $end,
      'key'         => $apiKey
   ],
   NULL
);

$received = Curl::send($request);
$routes = $received->getData()->routes[0];

// echo '<pre>', var_dump($received), '</pre>'; exit;
