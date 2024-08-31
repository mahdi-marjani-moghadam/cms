<?php

define('LARAVEL_START', microtime(true));


require __DIR__ . '/../vendor/autoload.php';
// cpanel
// require __DIR__.'/../cms/vendor/autoload.php';



$app = require_once __DIR__ . '/../bootstrap/app.php';
// cpanel
// $app = require_once __DIR__.'/../cms/bootstrap/app.php';
// $app->usePublicPath(__DIR__);



$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
