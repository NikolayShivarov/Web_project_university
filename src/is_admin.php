<?php
    require_once "db.php";
    session_start();
    $db = new Database();
    $userId = $_SESSION['userId'];
    $query = $db->selectUserByIdQuery(["id" => $userId]);
    $data = $query["data"]->fetch(PDO::FETCH_ASSOC);
    echo json_encode($data);
?>