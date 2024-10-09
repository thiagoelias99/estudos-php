<?php

namespace App\Traits;

trait ErrorMessageTrait
{
  public function setErrorMessage(string $message): void
  {
    $_SESSION['error_message'] = $message;
  }
}
