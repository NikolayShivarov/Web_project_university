<?php
  require_once "db.php";
  session_start();
  if ($_POST) {
    $data = json_decode($_POST['data'], true);
    $review = $data['text'];
    $questionId = $data['questionId'];
    $userId = $_SESSION['userId'];
    $userRating = $data['rating'];

    $db = new Database();
    $db->insertReviewQuery(['questionId' => $questionId, 'userId' => $userId, 'reviewText' => $review]);
    $db->insertRatingQuery([ 'userId' => $userId, 'questionId' => $questionId,'rating' => $userRating]);
  }

?>