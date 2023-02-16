<?php
  require_once "db.php";
  session_start();
  if ($_POST) {
    $data = json_decode($_POST['data'], true);
    $point = intval($data['text']);
    $questionId = $data['questionId'];

    $db = new Database();

    if ($point == 1){
        $db->addCorrectByIdQuery(['id' => $questionId]);
    }
    else{
        $db->addWrongByIdQuery(['id' => $questionId]);
    }
  }
  


?>