<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use App\Traits\RenderTemplateTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class VideoListController implements Controller
{
  use RenderTemplateTrait;

  public function __construct(
    private VideoRepository $videoRepository
  ) {}

  public function execute(ServerRequestInterface $request): ResponseInterface
  {
    $videos = $this->videoRepository->all();

    return new Response(200, body: $this->renderTemplate("video-list", [
      'videos' => $videos
    ]));
  }
}
