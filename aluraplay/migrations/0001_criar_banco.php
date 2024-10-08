<?php

$dbname = 'db';
$dbPath = __DIR__ . "/$dbname.sqlite";
$pdo = new PDO("sqlite:$dbPath");
$pdo->exec('CREATE TABLE videos (id INTEGER PRIMARY KEY, url TEXT, title TEXT);');