<?php
session_start();
define('DB_CONFIG_FILE', __DIR__ . '/../config/db.config.php');
define('DB_TABLE', 'customer_09');
define('SESSION_KEY', 'auth');

require __DIR__ . '/../Application/Autoload/Loader.php';

Application\Autoload\Loader::init(__DIR__ . '/..');

use Application\Database\Connection;
use Application\Acl\ { DbTable, Authenticate };
use Application\MiddleWare\ { ServerRequest, Request, Constants, TextStream };

// authentication adapter and core class
$conn = new Connection(include DB_CONFIG_FILE);
$dbAuth = new DbTable($conn, DB_TABLE);
$auth = new Authenticate($dbAuth, SESSION_KEY);

// client to server request + authenticate request
// $incoming = new ServerRequest();
// $incoming->initialize();
// $outbound = new Request();

use Application\MiddleWare\Uri;

$test = new Uri();
