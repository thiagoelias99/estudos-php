<?php

namespace App\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LogoutController implements Controller
{
  public function execute(ServerRequestInterface $request): ResponseInterface
  {
    $_SESSION['logged'] = false;
    return new Response(302, ['Location' => '/login']);
  }
}
