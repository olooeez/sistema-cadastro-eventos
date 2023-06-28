<?php

use \Luiz\Database\Connection;

abstract class EventModel
{
  public static function getAllEventsByPage($page)
  {
    $connection = Connection::get();
    $offset = $page * 3;
    $sql = "SELECT * FROM event LIMIT 3 OFFSET {$offset}";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $events = $stmt->fetchAll();

    for ($i = 0; $i < count($events); $i++) {
      $images = explode(",", $events[$i]["images"]);
      $events[$i]["images"] = $images;
    }

    return $events;
  }

  public static function getNumOfEvents()
  {
    $connection = Connection::get();
    $sql = "SELECT count(*) AS total FROM event";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result["total"];
  }
}
