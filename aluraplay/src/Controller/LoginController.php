<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use PDO;

class LoginController implements Controller
{
  private PDO $pdo;

  public function __construct(
    private VideoRepository $videoRepository
  ) {
    $dbname = 'db';
    $dbPath = __DIR__ . "/../../$dbname.sqlite";
    $this->pdo = new PDO("sqlite:$dbPath");
  }

  public function execute(): void
  {
    $username = filter_input(INPUT_POST, 'usuario');
    $password = filter_input(INPUT_POST, 'senha');

    $sql = "SELECT * FROM users WHERE email = :username";
    $statement = $this->pdo->prepare($sql);
    $statement->bindParam(':username', $username);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
    $isCorrectPassword = password_verify($password, $user['password']);

    if ($isCorrectPassword) {
      $_SESSION['logged'] = true;
      header('Location: /');
    } else {
      header('Location: /login?succes=false');
    }
  }
}
