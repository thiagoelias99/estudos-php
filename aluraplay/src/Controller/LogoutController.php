<?php

namespace App\Controller;

class LogoutController implements Controller
{
  public function execute(): void
  {
    $_SESSION['logged'] = false;
    header('Location: /login');
  }
}
