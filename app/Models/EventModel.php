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

  public static function getSpecificsEventsByPageAndCategory($title, $page, $categoryName)
  {
    $connection = Connection::get();
    $offset = $page * 3;
    if ($categoryName === 'Todas') {
      $sql = "SELECT event_id FROM event WHERE title LIKE '%{$title}' OR title LIKE '{$title}%' OR title LIKE '%{$title}%' LIMIT 3 OFFSET {$offset}";
    } else {
      $categoryId = CategoryModel::getCategoryId($categoryName);
      $sql = "SELECT event_id FROM event WHERE (title LIKE '%{$title}' OR title LIKE '{$title}%' OR title LIKE '%{$title}%') AND category_id = {$categoryId} LIMIT 3 OFFSET {$offset}";
    }

    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $eventsId = $stmt->fetchAll();
    $events = [];

    foreach ($eventsId as $eventId) {
      $sql = "SELECT * FROM event WHERE event_id = {$eventId["event_id"]}";
      $stmt = $connection->prepare($sql);
      $stmt->execute();
      array_push($events, $stmt->fetch());
    }

    for ($i = 0; $i < count($events); $i++) {
      $images = explode(",", $events[$i]["images"]);
      $events[$i]["images"] = $images;
    }

    return $events;
  }
}
