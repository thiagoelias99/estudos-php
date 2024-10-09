<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use App\Entity\Video;
use App\Traits\ErrorMessageTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UpdateVideoController implements RequestHandlerInterface
{
  use ErrorMessageTrait;

  public function __construct(
    private VideoRepository $videoRepository
  ) {}

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    $body = $request->getParsedBody();

    $id = filter_var($body['id'], FILTER_VALIDATE_INT);
    $url = filter_var($body['url'], FILTER_VALIDATE_URL);
    if ($url === false || $id === false) {
      $this->setErrorMessage('URL inválida');
      return new Response(400, ['Location' => '/']);
    }
    $titulo = filter_var($body['titulo']);

    $video = new Video($url, $titulo);
    $video->setId($id);

    if ($this->videoRepository->update($video)) {
      return new Response(302, ['Location' => '/']);
    } else {
      $this->setErrorMessage('Erro ao atualizar vídeo');
      return new Response(500, ['Location' => '/']);
    }
  }
}
