<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Controllers\ProductController;
use GuzzleHttp\Psr7\ServerRequest;
use HttpSoft\Emitter\SapiEmitter;
use League\Route\Router;

require __DIR__ . '/../vendor/autoload.php';

ini_set('display_errors', '1');

$request = ServerRequest::fromGlobals();

$router = new Router();

$router->get('/', [HomeController::class, "index"]);
$router->get('/list', [ProductController::class, "index"]);
$router->get('/product/{id:number}', [ProductController::class, "show"]);


$path = $request->getUri()->getPath();

$response = $router->dispatch($request);

$emitter = new SapiEmitter();

$emitter->emit($response);


