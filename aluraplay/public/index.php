<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Psr\Http\Server\RequestHandlerInterface;

session_start();
session_regenerate_id();

/** @var \Psr\Container\ContainerInterface $diContainer */
$diContainer = require_once __DIR__ . '/../src/config/dependencies.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];
$key = "$httpMethod|$pathInfo";

$isLoginRoute = $pathInfo === '/login';
if ($isLoginRoute) {

} else if (!array_key_exists('logged', $_SESSION) || $_SESSION['logged'] === false) {
    header('Location: /login');
    return;
}

$routes = require_once __DIR__ . "/../src/config/routes.php";

if (!array_key_exists($key, $routes)) {
    http_response_code(404);
    exit();
}

$controllerClass = $routes[$key];
/** @var RequestHandlerInterface $controller */
$controller = $diContainer->get($controllerClass);

$psr17Factory = new \Nyholm\Psr7\Factory\Psr17Factory();

$creator = new \Nyholm\Psr7Server\ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$request = $creator->fromGlobals();

$response = $controller->handle($request);
http_response_code($response->getStatusCode());
foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();