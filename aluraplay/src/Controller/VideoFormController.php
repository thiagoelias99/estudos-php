<?php

namespace App\Controller;

use App\Repository\VideoRepository;

class VideoFormController implements Controller
{
  public function __construct(
    private VideoRepository $videoRepository
  ) {}

  public function execute(): void
  {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null) {
      $url = "";
      $titulo = "";
    } else {
      $video = $this->videoRepository->find($id);
      $url = $video->url;
      $titulo = $video->title;
    }

    require __DIR__ . '/../Views/video-form.php';
  }
}
