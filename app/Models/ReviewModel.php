<?php

use \Luiz\Database\Connection;

abstract class ReviewModel
{
  public static function insert($userId, $eventId, $score, $comment)
  {
    $connection = Connection::get();
    $sql = "INSERT INTO review (user_id, event_id, score, comment) VALUES (:user_id, :event_id, :score, :comment)";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":user_id", $userId);
    $stmt->bindValue(":event_id", $eventId);
    $stmt->bindValue(":score", $score);
    $stmt->bindValue(":comment", $comment);
    return $stmt->execute();
  }

  public static function getAllReviewsByPage($page)
  {
    $connection = Connection::get();
    $offset = $page * 3;
    $sql = "SELECT * FROM review LIMIT 3 OFFSET {$offset}";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $reviews = $stmt->fetchAll();
    return $reviews;
  }

  public static function getAllReviewsByPageEventId($page, $eventId)
  {
    $connection = Connection::get();
    $offset = $page * 3;
    $sql = "SELECT r.*, u.user_id, u.name, u.email FROM review AS r INNER JOIN user AS u ON r.user_id = u.user_id WHERE r.event_id = :event_id ORDER BY r.review_id DESC LIMIT 3 OFFSET {$offset}";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":event_id", $eventId);
    $stmt->execute();
    $reviews = $stmt->fetchAll();
    return $reviews;
  }

  public static function getNumReviews($eventId)
  {
    $connection = Connection::get();
    $sql = "SELECT count(*) AS total FROM review WHERE event_id = :event_id";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":event_id", $eventId);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result["total"];
  }

  public static function delete($id)
  {
    $connection = Connection::get();
    $deleteReviewSql = "DELETE FROM review WHERE review_id = :review_id";
    $stmt = $connection->prepare($deleteReviewSql);
    $stmt->bindValue(":review_id", $id);
    return $stmt->execute();
  }
}
