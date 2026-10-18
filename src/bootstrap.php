<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Utils;
use HttpSoft\Emitter\SapiEmitter;
use League\Route\Router;

require __DIR__ . '/../vendor/autoload.php';

ini_set('display_errors', '1');

$request = ServerRequest::fromGlobals();

$router = new Router();

$router->map('GET', '/', function () {
    $stream = Utils::streamFor("Homepage");
    $response = new Response();
    $response = $response->withBody($stream);
    return $response;
});
$router->get('/list', function () {
    $stream = Utils::streamFor("List of products");
    $response = new Response();
    $response = $response->withBody($stream);
    return $response;
});
$router->get('/product/{id:number}', function ($request, array $args) {
    $id = $args['id'];
    $stream = Utils::streamFor("Single Product with ID $id");
    $response = new Response();
    $response = $response->withBody($stream);
    return $response;
});



$path = $request->getUri()->getPath();

$response = $router->dispatch($request);

$emitter = new SapiEmitter();

$emitter->emit($response);


