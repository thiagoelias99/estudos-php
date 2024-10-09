<?php

namespace App\Controller;

//Substituido por trait

abstract class ViewController implements Controller
{
  private const TEMPLATE_PATH = __DIR__ . '/../Views/'; 
  protected function renderTemplate(string $templateName, array $context = []): string
  {
    extract($context); // Extracts the array keys into variables

    ob_start(); // Starts output buffering
    require_once self::TEMPLATE_PATH . $templateName . '.php';
    return ob_get_clean(); // Gets the current buffer contents and delete current output buffer
  }
}
