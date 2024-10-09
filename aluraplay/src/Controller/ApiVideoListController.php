<?php

namespace App\Controller;

use App\Repository\VideoRepository;

class ApiVideoListController implements Controller
{
  public function __construct(
    private VideoRepository $videoRepository
  ) {}

  public function execute(): void
  {
    $videos = $this->videoRepository->all();
    echo json_encode($videos);
  }
}
