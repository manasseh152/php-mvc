<?php

namespace Src\Libraries\Core;

use PDO;
use PDOException;

/**
 * The Database class.
 */
class Database
{
  private static ?Database $instance = null;
  public PDO $db;

  /**
   * Creates a new Database instance.
   */
  public function __construct()
  {
    $options = [
      PDO::ATTR_PERSISTENT => true, // Persistent connection
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Throw PDOException on error
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, // Set default fetch mode to object
    ];

    try {
      $this->db = new PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}", $_ENV['DB_USER'], $_ENV['DB_PASS'], $options);
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  /**
   * Returns the Database instance.
   *
   * @return Database The Database instance.
   */
  public static function getInstance(): Database
  {
    if (self::$instance === null) {
      self::$instance = new Database();
    }
    return self::$instance;
  }
}
