<?php

use \Luiz\Database\Connection;

abstract class CategoryModel
{
  public static function getAllCategories()
  {
    $connection = Connection::get();
    $sql = "SELECT name FROM category";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }
  public static function getAllCategoriesByPage($page)
  {
    $connection = Connection::get();
    $offset = $page * 3;
    $sql = "SELECT * FROM category LIMIT 3 OFFSET {$offset}";
    ;
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();
    return $categories;
  }

  public static function getCategoryId($categoryName)
  {
    $connection = Connection::get();
    $sql = "SELECT category_id FROM category WHERE name = '{$categoryName}'";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    return $stmt->fetch()["category_id"];
  }
  public static function Delete($ID)
  {
    $connection = Connection::get();
    $connection->beginTransaction();

    try {
      $deleteEventSql = "DELETE FROM event WHERE event_id = :event_id";
      $stmt = $connection->prepare($deleteEventSql);
      $stmt->bindValue(":event_id", $ID);
      $stmt->execute();

      $deleteReviewSql = "DELETE FROM category WHERE category_id = :category_id";
      $stmt = $connection->prepare($deleteReviewSql);
      $stmt->bindValue(":category_id", $ID);
      $stmt->execute();

      $connection->commit();
      return true;
    } catch (PDOException $e) {
      $connection->rollBack();
      return false;
    }
  }
}