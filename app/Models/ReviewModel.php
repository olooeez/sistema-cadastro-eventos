<?php

use \Luiz\Database\Connection;

abstract class ReviewModel
{
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
    $sql = "SELECT * FROM review WHERE event_id = :event_id LIMIT 3 OFFSET {$offset}";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":event_id", $eventId);
    $stmt->execute();
    $reviews = $stmt->fetchAll();
    return $reviews;
  }

  public static function getNumReviews()
  {
    $connection = Connection::get();
    $sql = "SELECT count(*) AS total FROM review";
    $stmt = $connection->prepare($sql);
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
?>
