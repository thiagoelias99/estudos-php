<?php

$dbname = 'db';
$dbPath = __DIR__ . "/$dbname.sqlite";
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
if ($url === false || $id === false) {
  header('Location: /index.php?sucesso=0');
    exit();
}
$titulo = filter_input(INPUT_POST, 'titulo');

$sql = 'UPDATE videos SET url = :url, title = :title WHERE id = :id;';
$statement = $pdo->prepare($sql);
$statement->bindParam(':url', $url);
$statement->bindParam(':title', $titulo);
$statement->bindParam(':id', $id);

if ($statement->execute()) {
  header('Location: /index.php?success=true');
} else {
  header('Location: /index.php?success=false');
}
