<?php

class Core
{
  private $url;
  private $controller;
  private $method = "index";
  private $params = [];
  private $user;
  private $error;

  public function __construct()
  {
    $this->user = $_SESSION["user"] ?? null;
    $this->error = $_SESSION["message_error"] ?? null;

    if (isset($this->error)) {
      if ($this->error["count"] === 0) {
        $_SESSION["message_error"]["count"]++;
      } else {
        unset($_SESSION["message_error"]);
      }
    }
  }

  public function start($request)
  {
    if (isset($request["url"])) {
      $this->url = explode("/", $request["url"]);
      $this->controller = ucfirst($this->url[0]) . "Controller";
      array_shift($this->url);

      if (isset($this->url[0]) && $this->url != "") {
        $this->method = $this->url[0];
        array_shift($this->url);

        if (isset($this->url[0]) && $this->url != "") {
          $this->params = $this->url;
        }
      }
    }

    if ($this->user) {
      $pagesPermission = ["DashboardController", "EventController", "UserController"];

      if ($this->user['user_type'] === 'administrator') {
        array_push($pagesPermission, "AdminController");
      }

      if (!isset($this->controller) || !in_array($this->controller, $pagesPermission)) {
        $this->controller = "DashboardController";
        $this->method = "index";
      }
    } else {
      $pagesPermission = ["LoginController", "RegisterController"];

      if (!isset($this->controller) || !in_array($this->controller, $pagesPermission)) {
        $this->controller = "LoginController";
        $this->method = "index";
      }
    }

    return call_user_func(array(new $this->controller, $this->method), $this->params);
  }
}
