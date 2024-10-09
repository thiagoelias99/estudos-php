<?php

use App\Controller\{
  DeleteVideoController,
  NewVideoController,
  UpdateVideoController,
  VideoFormController,
  VideoListController,
  LoginFormController,
  LoginController,
  LogoutController,
  ApiVideoListController
};

return[
  "GET|/" => VideoListController::class,
  "GET|/novo-video" => VideoFormController::class,
  "POST|/novo-video" => NewVideoController::class,
  "GET|/editar-video" => VideoFormController::class,
  "POST|/editar-video" => UpdateVideoController::class,
  "POST|/remover-video" => DeleteVideoController::class,
  "GET|/login" => LoginFormController::class,
  "POST|/login" => LoginController::class,
  "GET|/logout" => LogoutController::class,
  "GET|/api/videos" => ApiVideoListController::class
];