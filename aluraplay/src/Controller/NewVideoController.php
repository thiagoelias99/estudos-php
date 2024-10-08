<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use App\Entity\Video;

class NewVideoController implements Controller
{
  public function __construct(
    private VideoRepository $videoRepository
  ) {}

  public function execute(): void
  {
    $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
    if ($url === false) {
      header('Location: /index.php?sucesso=0');
      exit();
    }
    $titulo = filter_input(INPUT_POST, 'titulo');

    if ($this->videoRepository->add(new Video($url, $titulo))) {
      header('Location: /index.php?success=true');
    } else {
      header('Location: /index.php?success=false');
    }
  }
}
