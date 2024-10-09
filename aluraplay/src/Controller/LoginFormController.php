<?php

namespace App\Controller;

use App\Repository\VideoRepository;

class LoginFormController implements Controller
{
  public function __construct(
    private VideoRepository $videoRepository
  ) {}

  public function execute(): void
  {
    if (array_key_exists('logged', $_SESSION) && $_SESSION['logged'] === true) {
      header('Location: /');
      return;
    }

    require __DIR__ . '/../Views/login-form.php';
  }
}
