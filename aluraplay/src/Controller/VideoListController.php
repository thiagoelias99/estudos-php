<?php

namespace App\Controller;

use App\Repository\VideoRepository;

class VideoListController implements Controller
{
  public function __construct(
    private VideoRepository $videoRepository
  ) {}

  public function execute(): void
  {
    $videos = $this->videoRepository->all();

    require __DIR__ . '/../Views/video-list.php';
  }
}