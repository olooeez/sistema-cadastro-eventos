<?php

class DashboardController
{

  public function index($page)
  {
    $loader = new \Twig\Loader\FilesystemLoader("app/Views");
    $twig = new \Twig\Environment($loader, ["auto_reload" => true]);
    $template = $twig->load("dashboard.html");
    $pageToLoad = isset($page[0]) ? intval($page[0]) : 0;
    $events = EventModel::getAllEventsByPage($pageToLoad);
    $parameters["user"] = $_SESSION["user"] ?? null;
    $parameters["events"] = $events;
    $parameters["total_num_events"] = $events;
    $parameters["current_page"] = $pageToLoad;

    return $template->render($parameters);
  }
}
