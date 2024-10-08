<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use App\Entity\Video;

class UpdateVideoController implements Controller
{
  public function __construct(
    private VideoRepository $videoRepository
  ) {}

  public function execute(): void
  {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
    if ($url === false || $id === false) {
      header('Location: /index.php?sucesso=0');
      exit();
    }
    $titulo = filter_input(INPUT_POST, 'titulo');

    $video = new Video($url, $titulo);
    $video->setId($id);

    if ($this->videoRepository->update($video)) {
      header('Location: /index.php?success=true');
    } else {
      header('Location: /index.php?success=false');
    }
  }
}
