<?php

$dbname = 'db';
$dbPath = __DIR__ . "/../$dbname.sqlite";
$pdo = new PDO("sqlite:$dbPath");
$pdo->exec('ALTER TABLE videos ADD COLUMN image_path TEXT DEFAULT NULL;');