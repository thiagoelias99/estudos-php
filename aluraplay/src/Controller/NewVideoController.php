<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use App\Entity\Video;
use App\Traits\ErrorMessageTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class NewVideoController implements RequestHandlerInterface
{
  use ErrorMessageTrait;

  public function __construct(
    private VideoRepository $videoRepository
  ) {}

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    $body = $request->getParsedBody();

    $url = filter_var($body['url'], FILTER_VALIDATE_URL);
    if ($url === false) {
      $this->setErrorMessage('URL inválida');
      return new Response(400, ['Location' => '/novo-video']);
    }
    $titulo = filter_var($body['titulo']);

    $video = new Video($url, $titulo);
    $files = $request->getUploadedFiles();
    /** @var UploadedFileInterface $uploadedImage */
    $uploadedImage = $files['image'];

    if ($uploadedImage->getError() === UPLOAD_ERR_OK) {
      //Verificar tipo do arquivo
      $tmpFile = $uploadedImage->getStream()->getMetadata('uri');
      $fileInfo = new \finfo(FILEINFO_MIME_TYPE);
      $mimeType = $fileInfo->file($tmpFile);
      $filePath = $uploadedImage->getClientFilename();

      if(str_starts_with($mimeType, 'image/')) {
        $safeFileName = uniqid('upload_') . '-' . basename($filePath);
        $uploadedImage->moveTo(__DIR__ . '/../../public/img/uploads/' . $safeFileName);
        $video->setFilePath($safeFileName);
      }
    }

    if ($this->videoRepository->add($video)) {
      return new Response(302, ['Location' => '/']);
    } else {
      $this->setErrorMessage('Erro ao adicionar vídeo');
      return new Response(500, ['Location' => '/novo-video']);
    }
  }
}
