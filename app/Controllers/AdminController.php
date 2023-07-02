<?php
class AdminController
{
  public function index($param)
  {
    header("Location: /sistema-cadastro-eventos/admin/event/0");
  }

  public function event($param)
  {
    $loader = new \Twig\Loader\FilesystemLoader("app/Views");
    $twig = new \Twig\Environment($loader, ["auto_reload" => true]);
    $template = $twig->load("admin_dashboard_event.html");
    $pageToLoad = isset($param[0]) ? intval($param[0]) : 0;
    $events = EventModel::getAllEventsByPage($pageToLoad);
    $parameters["loged_user"] = $_SESSION["user"] ?? null;
    $parameters["events"] = $events;
    $categories = CategoryModel::getAllCategories();
    $parameters["categories"] = $categories;
    $parameters["total_num_events"] = ceil(EventModel::getNumOfEvents() / 3) - 1;
    $parameters["current_page"] = $pageToLoad;
    return $template->render($parameters);
  }

  public function user($param)
  {
    $loader = new \Twig\Loader\FilesystemLoader("app/Views");
    $twig = new \Twig\Environment($loader, ["auto_reload" => true]);
    $template = $twig->load("admin_dashboard_user.html");
    $pageToLoad = isset($param[0]) ? intval($param[0]) : 0;
    $parameters["loged_user"] = $_SESSION["user"] ?? null;
    $users = UserModel::getAllUsersByPage($pageToLoad);
    $categories = CategoryModel::getAllCategories();
    $parameters["categories"] = $categories;
    $parameters["users"] = $users;
    $parameters["total_num_users"] = ceil(UserModel::getNumOfUsers() / 3) - 1;
    $parameters["current_page"] = $pageToLoad;
    return $template->render($parameters);
  }

  public function review($param)
  {
    $loader = new \Twig\Loader\FilesystemLoader("app/Views");
    $twig = new \Twig\Environment($loader, ["auto_reload" => true]);
    $template = $twig->load("admin_dashboard_review.html");
    $pageToLoad = isset($param[0]) ? intval($param[0]) : 0;
    $parameters["loged_user"] = $_SESSION["user"] ?? null;
    $reviews = ReviewModel::getAllReviewsByPage($pageToLoad);
    $categories = CategoryModel::getAllCategories();
    $parameters["categories"] = $categories;
    $parameters["reviews"] = $reviews;
    $parameters["total_num_reviews"] = ceil(ReviewModel::getNumReviews() / 3) - 1;
    $parameters["current_page"] = $pageToLoad;
    return $template->render($parameters);
  }

  public function category($param)
  {
    $loader = new \Twig\Loader\FilesystemLoader("app/Views");
    $twig = new \Twig\Environment($loader, ["auto_reload" => true]);
    $template = $twig->load("admin_dashboard_category.html");
    $pageToLoad = isset($param[0]) ? intval($param[0]) : 0;
    $parameters["loged_user"] = $_SESSION["user"] ?? null;
    $categoriesDashboard = CategoryModel::getAllCategoriesByPage($pageToLoad);
    $parameters["categories_dashboard"] = $categoriesDashboard;
    $categories = CategoryModel::getAllCategories();
    $parameters["categories"] = $categories;
    $parameters["total_num_categories"] = ceil(CategoryModel::getNumCategories() / 3) - 1;
    $parameters["current_page"] = $pageToLoad;
    return $template->render($parameters);
  }

  public function delete($params)
  {
    $tableName = $params[0];
    $id = $params[1];

    switch ($tableName) {
      case 'event':
        EventModel::delete($id);
        header("Location: /sistema-cadastro-eventos/admin/event/0");
        break;
      case 'user':
        UserModel::delete($id);
        header("Location: /sistema-cadastro-eventos/admin/user/0");
        break;
      case 'review':
        ReviewModel::delete($id);
        header("Location: /sistema-cadastro-eventos/admin/review/0");
        break;
      case 'category':
        CategoryModel::delete($id);
        header("Location: /sistema-cadastro-eventos/admin/category/0");
        break;
      default:
        header("Location: /sistema-cadastro-eventos/admin/event/0");
        break;
    }
  }
}
