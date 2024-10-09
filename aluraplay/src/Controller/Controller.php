<?php

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface Controller
{
  public function execute(ServerRequestInterface $request): ResponseInterface;
}
