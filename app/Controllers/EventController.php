<?php

class EventController
{
  public function list($page)
  {
    $loader = new \Twig\Loader\FilesystemLoader("app/Views");
    $twig = new \Twig\Environment($loader, ["auto_reload" => true]);
    $template = $twig->load("event_list.html");
    $pageToLoad = isset($page[0]) ? intval($page[0]) : 0;
    $searchName = $_POST["name"];
    $categoryName = $_POST["category"];
    $searchedEvents =  EventModel::getSpecificsEventsByPageAndCategory($searchName, $pageToLoad, $categoryName);
    $categories = CategoryModel::getAllCategories();
    $parameters["categories"] = $categories;
    $parameters["total_num_events"] = count($searchedEvents);
    $parameters["events"] = $searchedEvents;
    $parameters["category"] = $categoryName;
    $parameters["search_name"] = $searchName;
    $parameters["user"] = $_SESSION["user"] ?? null;
    return $template->render($parameters);
  }
}
