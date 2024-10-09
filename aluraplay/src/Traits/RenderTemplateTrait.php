<?php

namespace App\Traits;

trait RenderTemplateTrait
{
  private const TEMPLATE_PATH = __DIR__ . '/../Views/'; 
  private function renderTemplate(string $templateName, array $context = []): string
  {
    extract($context); // Extracts the array keys into variables

    ob_start(); // Starts output buffering
    require_once self::TEMPLATE_PATH . $templateName . '.php';
    return ob_get_clean(); // Gets the current buffer contents and delete current output buffer
  }
}