<?php

use \Luiz\Database\Connection;

class UserModel
{
  private $userId;
  private $name;
  private $email;
  private $password;
  private $userType;

  public function validateLogin()
  {
    $connection = Connection::get();
    $sql = "SELECT * FROM user WHERE email = :email";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":email", $this->email);
    $stmt->execute();

    if ($stmt->rowCount()) {
      $result = $stmt->fetch();

      if (password_verify($this->password, $result["password"])) {
        $_SESSION["user"] = $result;
      } else {
        throw new Exception("Senha icorreta");
      }
    } else {
      throw new Exception("Usuário não existe");
    }
  }

  public function insert()
  {
    $connection = Connection::get();
    $sql = "INSERT INTO user (name, email, password, user_type) VALUES (:name, :email, :password, :user_type)";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":name", $this->name);
    $stmt->bindValue(":email", $this->email);
    $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
    $stmt->bindValue(":password", $hashedPassword);
    $stmt->bindValue(":user_type", $this->userType);

    if ($this->alreadyInDB()) {
      throw new Exception("E-mail digitado já está sendo usado!");
    }

    if ($stmt->execute()) {
      $lastRegisterUser = $this->getLastInsertUser();
      $_SESSION["user"] = $lastRegisterUser;
    } else {
      throw new Exception("Registro inválido");
    }
  }

  private function alreadyInDB() {
    $connection = Connection::get();
    $sql = "SELECT * FROM user WHERE email = :email";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":email", $this->email);
    $stmt->execute();
    return $stmt->rowCount() > 0;
  }

  private function getLastInsertUser()
  {
    $connection = Connection::get();
    $userId = $connection->lastInsertId();
    $sql = "SELECT * FROM user WHERE user_id = :id";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(":id", $userId);
    $stmt->execute();
    return $stmt->fetch();
  }

  public function setUserType($userType)
  {
    $this->userType = $userType;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getPassword()
  {
    return $this->password;
  }
}
