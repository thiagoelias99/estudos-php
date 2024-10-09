<?php

namespace App\Controller;

//Não mais usado

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface Controller
{
  public function execute(ServerRequestInterface $request): ResponseInterface;
}
