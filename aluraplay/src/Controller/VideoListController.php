<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class VideoListController implements RequestHandlerInterface
{
  public function __construct(
    private VideoRepository $videoRepository,
    private \League\Plates\Engine $templates
  ) {}

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    $videos = $this->videoRepository->all();

    return new Response(200, body: $this->templates->render("video-list", [
      'videos' => $videos
    ]));
  }
}
