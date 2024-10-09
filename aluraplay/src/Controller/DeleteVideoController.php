<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use App\Traits\ErrorMessageTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DeleteVideoController implements RequestHandlerInterface
{
  use ErrorMessageTrait;

  public function __construct(
    private VideoRepository $videoRepository
  ) {}

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    $queryParams = $request->getParsedBody();
    $id = filter_var($queryParams['id'], FILTER_VALIDATE_INT);
    if ($this->videoRepository->remove($id)) {
      $this->setErrorMessage('Erro ao excluir o vídeo');
      return new Response(500, ['Location' => '/']);
    } else {
      return new Response(302, ['Location' => '/']);
    }
  }
}
