<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// maintenance mode
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// autoload vendor (HARUS ../vendor)
require __DIR__.'/../vendor/autoload.php';

// bootstrap app
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
