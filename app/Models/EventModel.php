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

  public static function getEventsRegistrated($userId)
  {
    $connection = Connection::get();
    $sql = "SELECT event_id FROM registration WHERE user_id = :user_id";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":user_id", $userId);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public static function getEventsByPage($eventsId, $page)
  {
    if (count($eventsId) == 0) {
      return [];
    }

    $connection = Connection::get();
    $offset = $page * 3;
    $limit = 3;
    $events = [];

    $sql = "SELECT * FROM event WHERE event_id IN (";

    $eventIdsCount = count($eventsId);
    for ($i = 0; $i < $eventIdsCount; $i++) {
      $sql .= "{$eventsId[$i]['event_id']}";
      if ($i < $eventIdsCount - 1) {
        $sql .= ",";
      }
    }

    $sql .= ") ORDER BY event_id LIMIT {$limit} OFFSET {$offset}";

    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $events = $stmt->fetchAll();

    for ($i = 0; $i < count($events); $i++) {
      $images = explode(",", $events[$i]["images"]);
      $events[$i]["images"] = $images;
    }

    return $events;
  }

  public static function getEventsOrganizer($userId)
  {
    $connection = Connection::get();
    $sql = "SELECT event_id FROM event WHERE user_id = :user_id";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":user_id", $userId);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public static function insert($title, $price, $date, $time, $locale, $category, $image, $description, $userId)
  {
    $connection = Connection::get();
    $sql = "INSERT INTO event (title, description, date, time, location, category_id, user_id, price, images) VALUES (:title, :description, :date, :time, :location, :category_id, :user_id, :price, :images)";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":title", $title);
    $stmt->bindValue(":price", $price);
    $stmt->bindValue(":date", $date);
    $stmt->bindValue(":time", $time);
    $stmt->bindValue(":location", $locale);
    $stmt->bindValue(":category_id", $category);
    $stmt->bindValue(":images", $image);
    $stmt->bindValue(":description", $description);
    $stmt->bindValue(":user_id", $userId);
    if ($stmt->execute()) {
      return $connection->lastInsertId();
    } else {
      return false;
    }
  }

  public static function delete($id)
  {
    $connection = Connection::get();
    $deleteEventSql = "DELETE FROM event WHERE event_id = :event_id";
    $stmt = $connection->prepare($deleteEventSql);
    $stmt->bindValue(":event_id", $id);
    return $stmt->execute();
  }

  public static function getEvent($id)
  {
    $connection = Connection::get();
    $selectEventSql = "SELECT * FROM event WHERE event_id = :event_id";
    $stmt = $connection->prepare($selectEventSql);
    $stmt->bindValue(":event_id", $id);
    $stmt->execute();
    $event = $stmt->fetch();
    $images = explode(",", $event["images"]);
    $event["images"] = $images;
    return $event;
  }
}
