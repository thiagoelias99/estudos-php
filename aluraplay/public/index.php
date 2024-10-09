<?php

use App\Repository\VideoRepository;
require_once __DIR__ . "/../vendor/autoload.php";
use Psr\Http\Server\RequestHandlerInterface;

session_start();
session_regenerate_id();

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];
$key = "$httpMethod|$pathInfo";

$isLoginRoute = $pathInfo === '/login';
if (!array_key_exists('logged', $_SESSION) || $_SESSION['logged'] === false && !$isLoginRoute) {
    header('Location: /login');
    return;
}

$routes = require_once __DIR__ . "/../src/config/routes.php";

if (!array_key_exists($key, $routes)) {
    http_response_code(404);
    exit();
}

$dbname = 'db';
$dbPath = __DIR__ . "/../$dbname.sqlite";
$pdo = new PDO("sqlite:$dbPath");
$videoRepository = new VideoRepository($pdo);

$controllerClass = $routes[$key];
/** @var RequestHandlerInterface $controller */
$controller = new $controllerClass($videoRepository);





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
        header (sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();
