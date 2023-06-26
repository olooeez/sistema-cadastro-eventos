<?php

use Luiz\Database\Connection;

class RegisterController
{
  public function index()
  {
    $loader = new \Twig\Loader\FilesystemLoader("app/Views");
    $twig = new \Twig\Environment($loader, ["auto_reload" => true]);
    $template = $twig->load("register.html");
    $parameters["error"] = $_SESSION["message_error"] ?? null;
    return $template->render($parameters);
  }

  public function create()
  {
    try {
      if ($_POST["password"] != $_POST["confirmPassword"]) {
        throw new Exception("A senhas não betem uma com a outra");
      }

      $user = new UserModel;
      $user->setName($_POST["name"]);
      $user->setEmail($_POST["email"]);
      $user->setPassword($_POST["password"]);
      $user->setUserType("participant");
      $user->insert();
      header("Location: http://localhost/sistema-cadastro-eventos/dashboard");
    } catch (Exception $e) {
      $_SESSION["message_error"] = array("message" => $e->getMessage(), "count" => 0);
      header("Location: http://localhost/sistema-cadastro-eventos/register");
    }
  }
}
