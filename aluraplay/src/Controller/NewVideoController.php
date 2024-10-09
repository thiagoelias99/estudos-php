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

    $video = new Video($url, $titulo);

    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
      move_uploaded_file(
        $_FILES['image']['tmp_name'],
        __DIR__ . '/../../public/img/uploads/' . $_FILES['image']['name']
      );
      $video->setFilePath($_FILES['image']['name']);
    }


    if ($this->videoRepository->add($video)) {
      header('Location: /index.php?success=true');
    } else {
      header('Location: /index.php?success=false');
    }
  }
}
