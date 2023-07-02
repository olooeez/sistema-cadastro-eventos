<?php
class AdminController
{
    public function index($param)
    {
        $loader = new \Twig\Loader\FilesystemLoader("app/Views");
        $twig = new \Twig\Environment($loader, ["auto_reload" => true]);
        $template = $twig->load("AdminDashboard.html");
        $pageToLoad = isset($param[0]) ? intval($param[0]) : 0;
        $events = EventModel::getAllEventsByPage($pageToLoad);
        
        
        $parameters["loged_user"] = $_SESSION["user"] ?? null;
        $parameters["events"] = $events;
        $parameters["total_num_events"] = EventModel::getNumOfEvents();
        $parameters["current_page"] = $pageToLoad;

        $categories = CategoryModel::getAllCategoriesByPage($pageToLoad);
        $parameters["categories"] = $categories;
        

        $users = UserModel::getAllUsersByPage($pageToLoad);
        $parameters["users"] = $users;
        $parameters["total_num_users"] = UserModel::getNumOfUsers();
        

        $reviews = ReviewModel::getAllReviewsByPage($pageToLoad);
        $parameters["reviews"] = $reviews;


        return $template->render($parameters);
    }
    public function event($param){
        $metodo = $param[0];
        $ID = $param[1];
        if($metodo === "update"){

        }else if($metodo === "delete"){
            EventModel::Delete($ID);
            header("Location: /sistema-cadastro-eventos/admin/index/");
        }
    }
    public function user($param){
        $metodo = $param[0];
        $ID = $param[1];
        if($metodo === "update"){

        }else if($metodo === "delete"){
            UserModel::Delete($ID);
            header("Location: /sistema-cadastro-eventos/admin/index/");
        }
    }
    public function review($param){
        $metodo = $param[0];
        $ID = $param[1];
        if($metodo === "update"){

        }else if($metodo === "delete"){
            ReviewModel::Delete($ID);
            header("Location: /sistema-cadastro-eventos/admin/index/");
        }
    }
    public function category($param){
        $metodo = $param[0];
        $ID = $param[1];
        if($metodo === "update"){

        }else if($metodo === "delete"){
            CategoryModel::Delete($ID);
            header("Location: /sistema-cadastro-eventos/admin/index/");
        }
    }
}
?>