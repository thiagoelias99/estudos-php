<?php

use App\Controller\{
  DeleteVideoController,
  NewVideoController,
  UpdateVideoController,
  VideoFormController,
  VideoListController
};

return[
  "GET|/" => VideoListController::class,
  "GET|/novo-video" => VideoFormController::class,
  "POST|/novo-video" => NewVideoController::class,
  "GET|/editar-video" => VideoFormController::class,
  "POST|/editar-video" => UpdateVideoController::class,
  "POST|/remover-video" => DeleteVideoController::class
];