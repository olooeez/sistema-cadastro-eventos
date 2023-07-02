<?php

class UserController
{
  public function index($args)
  {
    $loader = new \Twig\Loader\FilesystemLoader("app/Views");
    $twig = new \Twig\Environment($loader, ["auto_reload" => true]);
    $template = $twig->load("user.html");
    $categories = CategoryModel::getAllCategories();
    $userId = intval($args[0]);
    $user = UserModel::getUser($userId);
    $parameters["user"] = $user;
    $parameters["categories"] = $categories;
    $parameters["loged_user"] = $_SESSION["user"] ?? null;

    if ($user["user_type"] === 'participant') {
      $eventsId = EventModel::getEventsRegistrated($userId);
    } else if ($user["user_type"] === 'organizer') {
      $eventsId = EventModel::getEventsOrganizer($userId);
    } else {
      $eventsId = [];
    }

    $pageToLoad = isset($args[1]) ? intval($args[1]) : 0;
    $events = EventModel::getEventsByPage($eventsId, $pageToLoad);
    $parameters["total_num_events"] = ceil((count($eventsId) / 3)) - 1;
    $parameters["events"] = $events;
    $parameters["current_page"] = $pageToLoad;
    return $template->render($parameters);
  }

  public function logout()
  {
    unset($_SESSION);
    session_destroy();
    header("Location: /sistema-cadastro-eventos/");
  }
}
