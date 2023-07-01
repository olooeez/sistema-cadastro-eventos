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

  public static function Insert($titulo,$Preco,$Data,$Horario,$Localizacao,$category,$Imagem,$Descricao,$userId){
    $connection = Connection::get();
    $sql = "INSERT INTO event (title, description, date, time, location, category_id, user_id, price, images) 
    VALUES (:title, :description, :date, :time, :location, :category_id, :user_id, :price, :images)";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":title",$titulo);
    $stmt->bindValue(":price",$Preco);
    $stmt->bindValue(":date",$Data);
    $stmt->bindValue(":time",$Horario);
    $stmt->bindValue(":location",$Localizacao);
    $stmt->bindValue(":category_id",$category);
    $stmt->bindValue(":images",$Imagem);
    $stmt->bindValue(":description",$Descricao);
    $stmt->bindValue(":user_id",$userId);
    if($stmt->execute()){
        return $connection->lastInsertId();
    }else{
        return false;
    }
    
  }
}
