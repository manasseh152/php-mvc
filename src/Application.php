<?php

namespace Src;

use Dotenv\Dotenv;

use Src\Libraries\Core\Core;

class Application
{
  public static function init(): void
  {
    $init = new Core();
  }

  public static function loadEnv(): void
  {
    $dotenv = Dotenv::createImmutable('../');
    $dotenv->load();
    $dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'APP_ENV', 'APP_NAME', 'APP_URL']);
  }
}
