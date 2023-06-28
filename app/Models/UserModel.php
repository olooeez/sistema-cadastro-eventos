<?php

use \Luiz\Database\Connection;

abstract class UserModel
{
  public static function validateLogin($email, $password)
  {
    $connection = Connection::get();
    $sql = "SELECT * FROM user WHERE email = :email";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":email", $email);
    $stmt->execute();

    if ($stmt->rowCount()) {
      $result = $stmt->fetch();

      if (password_verify($password, $result["password"])) {
        $_SESSION["user"] = $result;
      } else {
        throw new Exception("Senha icorreta");
      }
    } else {
      throw new Exception("Usuário não existe");
    }
  }

  public static function insert($name, $email, $password, $userType)
  {
    $connection = Connection::get();
    $sql = "INSERT INTO user (name, email, password, user_type) VALUES (:name, :email, :password, :user_type)";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":name", $name);
    $stmt->bindValue(":email", $email);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bindValue(":password", $hashedPassword);
    $stmt->bindValue(":user_type", $userType);

    if (static::alreadyInDB($email)) {
      throw new Exception("E-mail digitado já está sendo usado!");
    }

    if ($stmt->execute()) {
      $lastRegisterUser = static::getLastInsertUser();
      $_SESSION["user"] = $lastRegisterUser;
    } else {
      throw new Exception("Registro inválido");
    }
  }

  private static function alreadyInDB($email)
  {
    $connection = Connection::get();
    $sql = "SELECT * FROM user WHERE email = :email";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":email", $email);
    $stmt->execute();
    return $stmt->rowCount() > 0;
  }

  private static function getLastInsertUser()
  {
    $connection = Connection::get();
    $userId = $connection->lastInsertId();
    $sql = "SELECT * FROM user WHERE user_id = :id";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":id", $userId);
    $stmt->execute();
    return $stmt->fetch();
  }
}
