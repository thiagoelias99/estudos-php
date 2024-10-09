<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use App\Traits\RenderTemplateTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginFormController implements Controller
{
  use RenderTemplateTrait;

  public function __construct(
    private VideoRepository $videoRepository
  ) {}

  public function execute(ServerRequestInterface $request): ResponseInterface
  {
    if (array_key_exists('logged', $_SESSION) && $_SESSION['logged'] === true) {
      return new Response(302, ['Location' => '/']);
    }

    return new Response(200, body: $this->renderTemplate("login-form"));
  }
}
