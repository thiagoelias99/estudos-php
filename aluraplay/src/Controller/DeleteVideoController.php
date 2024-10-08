<?php

namespace App\Controller;

use App\Repository\VideoRepository;

class DeleteVideoController implements Controller
{
  public function __construct(
    private VideoRepository $videoRepository
  ) {}

  public function execute(): void
  {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    if ($this->videoRepository->remove($id)) {
      header('Location: /index.php?sucesso=0');
    } else {
      header('Location: /index.php?sucesso=1');
    }
  }
}
