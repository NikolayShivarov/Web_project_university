<?php
  require_once "db.php";
  session_start();
  if ($_POST) {
    $data = json_decode($_POST['data'], true);
    $review = $data['text'];
    $questionId = $data['questionId'];
    $userId = $_SESSION['userId'];

    $db = new Database();
    $db->insertReviewQuery(['questionId' => $questionId, 'userId' => $userId, 'reviewText' => $review]);
  }

?>