<?php

class ReviewController
{

  public function create($params)
  {
    $eventId = intval($params[0]);
    $comment = $_POST["comment"];
    $userId = $_SESSION["user"]["user_id"];
    $score = $_POST["score"];
    ReviewModel::insert($userId, $eventId, $score, $comment);
    header("Location: /sistema-cadastro-eventos/event/index/{$eventId}");
  }
}
