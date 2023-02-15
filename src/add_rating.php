<?php
  require_once "db.php";
  session_start();
  if ($_POST) {
    $data = json_decode($_POST['data'], true);
    $rating = intval($data['text']);
    $questionId = $data['questionId'];
    $userId = $_SESSION['userId'];

    $db = new Database();
    $db->insertRatingQuery([ 'userId' => $userId, 'questionId' => $questionId,'rating' => $rating]);
  }
  


?>