<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use App\Traits\ErrorMessageTrait;
use Nyholm\Psr7\Response;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginController implements Controller
{
  use ErrorMessageTrait;

  private PDO $pdo;

  public function __construct(
    private VideoRepository $videoRepository
  ) {
    $dbname = 'db';
    $dbPath = __DIR__ . "/../../$dbname.sqlite";
    $this->pdo = new PDO("sqlite:$dbPath");
  }

  public function execute(ServerRequestInterface $request): ResponseInterface
  {
    $body = $request->getParsedBody();
    $username = filter_var($body['usuario']);
    $password = filter_var($body['senha']);

    $sql = "SELECT * FROM users WHERE email = :username";
    $statement = $this->pdo->prepare($sql);
    $statement->bindParam(':username', $username);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
    $isCorrectPassword = password_verify($password, $user['password']);

    if ($isCorrectPassword) {
      if (password_needs_rehash($user['password'], PASSWORD_ARGON2ID)) {
        $statement = $this->pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
        $statement->bindValue(1, password_hash($password, PASSWORD_ARGON2ID));
        $statement->bindValue(2, $user['id']);
        $statement->execute();
      }

      $_SESSION['logged'] = true;
      return new Response(302, ['Location' => '/']);
    } else {
      $this->setErrorMessage('Usuário ou senha inválidos');
      return new Response(404, ['Location' => '/login']);
    }
  }
}
