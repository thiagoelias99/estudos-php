<?php

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions([
  PDO::class => function (): PDO {
    $dbname = 'db';
    $dbPath = __DIR__ . "/../../$dbname.sqlite";
    return new PDO("sqlite:$dbPath");
  },
]);

/** @var \Psr\Container\ContainerInterface $container */
$container = $builder->build();

return $container;