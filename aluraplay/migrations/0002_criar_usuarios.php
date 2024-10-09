<?php

$dbname = 'db';
$dbPath = __DIR__ . "/../$dbname.sqlite";
$pdo = new PDO("sqlite:$dbPath");
$pdo->exec('CREATE TABLE users (id INTEGER PRIMARY KEY, email TEXT, password TEXT);');