<?php

use Symfony\Component\Dotenv\Dotenv;

define('LARAVEL_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/../.env');

header("Access-Control-Allow-Origin: " . $_ENV['CLIENT_APP_URL']);
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: content-type");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
