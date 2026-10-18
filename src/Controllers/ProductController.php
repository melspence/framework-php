<?php

declare(strict_types=1);

namespace App\Controllers;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Utils;

class ProductController
{
    public function index(): Response
    {
        $stream = Utils::streamFor("List of Products");
        $response = new Response();
        $response = $response->withBody($stream);
        return $response;
    }

    public function show(ServerRequest $request, array $args): Response
    {
        $id = $args['id'];
        $stream = Utils::streamFor("Single Product with ID $id");
        $response = new Response();
        $response = $response->withBody($stream);
        return $response;
    }
}
