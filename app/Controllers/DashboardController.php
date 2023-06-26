<?php

class DashboardController
{
  public function index()
  {
    $loader = new \Twig\Loader\FilesystemLoader("app/Views");
    $twig = new \Twig\Environment($loader, ["auto_reload" => true]);
    $template = $twig->load("dashboard.html");
    $parameters["user"] = $_SESSION["user"] ?? null;
    return $template->render($parameters);
  }

  public function logout()
  {
    unset($_SESSION);
    session_destroy();
    header("Location: /sistema-cadastro-eventos/");
  }
}
