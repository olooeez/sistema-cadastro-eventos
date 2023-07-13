<?php

class EventController
{
  public function index($params)
  {
    $loader = new \Twig\Loader\FilesystemLoader("app/Views");
    $twig = new \Twig\Environment($loader, ["auto_reload" => true]);
    $template = $twig->load("event.html");
    $categories = CategoryModel::getAllCategories();
    $eventId = intval($params[0]);
    $pageToLoad = isset($params[1]) ? intval($params[1]) : 0;
    $event = EventModel::getEvent($eventId);
    $reviews = ReviewModel::getAllReviewsByPageEventId($pageToLoad, $eventId);
    $parameters["total_num_events"] = ceil((ReviewModel::getNumReviews($eventId) / 3)) - 1;
    $parameters["current_page"] = $pageToLoad;
    $parameters["reviews"] = $reviews;
    $parameters["event"] = $event;
    $parameters["categories"] = $categories;
    $parameters["loged_user"] = $_SESSION["user"] ?? null;
    return $template->render($parameters);
  }

  public function list($page)
  {
    $loader = new \Twig\Loader\FilesystemLoader("app/Views");
    $twig = new \Twig\Environment($loader, ["auto_reload" => true]);
    $template = $twig->load("event_list.html");
    $pageToLoad = isset($page[0]) ? intval($page[0]) : 0;
    $searchName = $_POST["name"];
    $categoryName = $_POST["category"];
    $searchedEvents = EventModel::getSpecificsEventsByPageAndCategory($searchName, $pageToLoad, $categoryName);
    $categories = CategoryModel::getAllCategories();
    $parameters["categories"] = $categories;
    $parameters["total_num_events"] = ceil((count($searchedEvents) / 3)) - 1;
    $parameters["events"] = $searchedEvents;
    $parameters["category"] = $categoryName;
    $parameters["search_name"] = $searchName;
    $parameters["loged_user"] = $_SESSION["user"] ?? null;
    return $template->render($parameters);
  }

  public function create()
  {
    $title = $_POST["title"];
    $price = substr($_POST["price"], 1, strlen($_POST["price"]));
    $data = $_POST["date"];
    $time = $_POST["time"];
    $locale = $_POST["locale"];
    $category = CategoryModel::getCategoryId($_POST["category"]);
    $description = $_POST["description"];
    $userId = $_SESSION["user"]["user_id"];
    $images = "";
    if (isset($_FILES["image"])) {
      $imageFolder = "uploads/";

      foreach ($_FILES["image"]["tmp_name"] as $key => $tmpName) {
        $imageName = $_FILES["image"]["name"][$key];
        $imagePath = $imageFolder . $imageName;

        if (move_uploaded_file($tmpName, $imagePath)) {
          $images .= "{$imagePath},";
        }
      }


      $images = substr($images, 0, strlen($images) - 1);

      $retorno = EventModel::insert($title, $price, $data, $time, $locale, $category, $images, $description, $userId);
      if ($retorno) {
        header("Location: /sistema-cadastro-eventos/event/index/{$retorno}");
      }
    }
  }
}
