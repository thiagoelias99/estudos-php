<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use App\Traits\RenderTemplateTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class VideoFormController implements Controller
{
  use RenderTemplateTrait;

  public function __construct(
    private VideoRepository $videoRepository
  ) {}

  public function execute(ServerRequestInterface $request): ResponseInterface
  {
    $params = $request->getQueryParams();

    $id = filter_var($params['id'], FILTER_VALIDATE_INT);
    if ($id === false || $id === null) {
      $url = "";
      $titulo = "";
    } else {
      $video = $this->videoRepository->find($id);
      $url = $video->url;
      $titulo = $video->title;
    }

    return new Response(200, body: $this->renderTemplate("video-form", [
      'url' => $url,
      'titulo' => $titulo
    ]));
  }
}
