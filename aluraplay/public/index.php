<?php

use App\Repository\VideoRepository;
use App\Controller\Controller;
require_once __DIR__ . "/../vendor/autoload.php";

session_start();

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
/** @var Controller $controller */
$controller = new $controllerClass($videoRepository);
$controller->execute();
