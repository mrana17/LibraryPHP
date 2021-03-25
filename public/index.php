<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);

$whoops = new \Whoops\Run;
$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler);
$whoops->register();

$request = Request::createFromGlobals();
$routes = require __DIR__ . '/../config/routes.php';
$response = new Response('404 - Not Found', 404);
$response->send();


foreach ($routes as $route) {
    if ($method === $route[0] && $uri === $route[1]) {
        $response = call_user_func($route[2]);
    }
};

echo $response;