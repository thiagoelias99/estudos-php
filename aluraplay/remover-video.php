<?php

$dbname = 'db';
$dbPath = __DIR__ . "/$dbname.sqlite";
$pdo = new PDO("sqlite:$dbPath");

$id = $_POST['id'];
$sql = 'DELETE FROM videos WHERE id = ?';
$statement = $pdo->prepare($sql);
$statement->bindValue(1, $id);

if ($statement->execute() === false) {
  header('Location: /index.php?sucesso=0');
} else {
  header('Location: /index.php?sucesso=1');
}
