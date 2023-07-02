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
  public static function Delete($ID)
  {
    $connection = Connection::get();
    $connection->beginTransaction();

    try {
      $deleteReviewSql = "DELETE FROM review WHERE review_id = :review_id";
      $stmt = $connection->prepare($deleteReviewSql);
      $stmt->bindValue(":review_id", $ID);
      $stmt->execute();
      
      $connection->commit();
      return true;
    } catch (PDOException $e) {
      $connection->rollBack();
      return false;
    }
  }
}
?>