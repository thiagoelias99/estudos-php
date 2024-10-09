<?php

$dbname = 'db';
$dbPath = __DIR__ . "/../$dbname.sqlite";
$pdo = new PDO("sqlite:$dbPath");

$email = $argv[1];
$password = $argv[2];
$hash = password_hash($password, PASSWORD_ARGON2ID);

$sql = 'INSERT INTO users (email, password) VALUES (?, ?);';
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $email);
$statement->bindValue(2, $hash);
$statement->execute();