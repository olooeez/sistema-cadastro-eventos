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
        $searchedEvents = EventModel::getSpecificsEventsByPageAndCategory($searchName, $pageToLoad, $categoryName);
        $categories = CategoryModel::getAllCategories();
        $parameters["categories"] = $categories;
        $parameters["total_num_events"] = count($searchedEvents) - 1;
        $parameters["events"] = $searchedEvents;
        $parameters["category"] = $categoryName;
        $parameters["search_name"] = $searchName;
        $parameters["loged_user"] = $_SESSION["user"] ?? null;
        return $template->render($parameters);
    }

    public function create()
    {
        $titulo = $_POST["Titulo"];
        $Preco = $_POST["Preço"];
        $Data = $_POST["Data"];
        $Horario = $_POST["Horario"];
        $Localizacao = $_POST["Localização"];
        $category = CategoryModel::getCategoryId($_POST["category"]);
        $Descricao = $_POST["Descrição"];
        $userId = $_SESSION["user"]["user_id"];

        if (isset($_FILES["Imagem"]) && $_FILES["Imagem"]["error"] == 0) {
            $pasta_destino = "assets/images/"; // Define a pasta onde o Imagem será armazenado
            $nome_imagem = $_FILES["Imagem"]["name"];
            $caminho_imagem = $pasta_destino . $nome_imagem;

            // Move o Imagem para a pasta de destino
            if (move_uploaded_file($_FILES["Imagem"]["tmp_name"], $caminho_imagem)) {
                $retorno = EventModel::Insert($titulo, $Preco,$Data,$Horario,$Localizacao,$category,$caminho_imagem,$Descricao,$userId);
                if($retorno){
                    header("Location: /sistema-cadastro-eventos/event/index/{$retorno}");
                }
            }
        }
    }
    
}