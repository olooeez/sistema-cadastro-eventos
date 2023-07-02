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

  public static function getNumCategories()
  {
    $connection = Connection::get();
    $sql = "SELECT count(*) AS total FROM category";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result["total"];
  }

  public static function delete($id)
  {
    $connection = Connection::get();
    $deleteCategorySql = "DELETE FROM category WHERE category_id = :category_id";
    $stmt = $connection->prepare($deleteCategorySql);
    $stmt->bindValue(":category_id", $id);
    return $stmt->execute();
  }
}
