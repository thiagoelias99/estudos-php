<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ApiVideoListController implements Controller
{
  public function __construct(
    private VideoRepository $videoRepository
  ) {}

  public function execute(ServerRequestInterface $request): ResponseInterface
  {
    $videos = $this->videoRepository->all();
    return new Response(200, [
      'Content-Type' => 'application/json'
    ], body: json_encode($videos));
  }
}
