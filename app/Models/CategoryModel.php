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

  public static function getCategoryId($categoryName)
  {
    $connection = Connection::get();
    $sql = "SELECT category_id FROM category WHERE name = '{$categoryName}'";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    return $stmt->fetch()["category_id"];
  }
}
