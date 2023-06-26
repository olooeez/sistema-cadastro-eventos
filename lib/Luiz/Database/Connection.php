<?php

namespace Luiz\Database;

use PDO;

abstract class Connection
{
  private static $connection;
  public static function get()
  {
    if (!self::$connection) {
      $env = parse_ini_file(realpath(dirname(__FILE__, 4) . "/.env"));
      self::$connection = new PDO("mysql: host={$env["host"]}; dbname={$env["database"]}", "{$env["user"]}", "{$env["password"]}");
    }

    return self::$connection;
  }
}
