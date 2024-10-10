<?php

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions([
  PDO::class => function (): PDO {
    $dbname = 'db';
    $dbPath = __DIR__ . "/../../$dbname.sqlite";
    return new PDO("sqlite:$dbPath");
  },
  \League\Plates\Engine::class => function () {
    $templatePath = __DIR__ . '/../Views';
    return new League\Plates\Engine($templatePath);
  }
]);

/** @var \Psr\Container\ContainerInterface $container */
$container = $builder->build();

return $container;
