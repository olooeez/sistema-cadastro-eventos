<?php

class LoginController
{
  public function index()
  {
    $loader = new \Twig\Loader\FilesystemLoader("app/Views");
    $twig = new \Twig\Environment($loader, ["auto_reload" => true]);
    $template = $twig->load("login.html");
    $parameters["error"] = $_SESSION["message_error"] ?? null;
    return $template->render($parameters);
  }

  public function check()
  {
    try {
      $user = new UserModel;
      $user->setEmail($_POST["email"]);
      $user->setPassword($_POST["password"]);
      $user->validateLogin();
      header("Location: http://localhost/sistema-cadastro-eventos/dashboard");
    } catch (\Exception $e) {
      $_SESSION["message_error"] = array("message" => $e->getMessage(), "count" => 0);
      header("Location: http://localhost/sistema-cadastro-eventos/login");
    }
  }
}
