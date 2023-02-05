<?php
require_once 'db.php';

function selectByCategory($category) {
    $db= new Database();
    $query = $db->selectQuestionsByCategoryQuery(["category" => $category]);
    
    if ($query["success"]) {
        $data = array();
        $data = $query["data"]->fetchAll(PDO::FETCH_ASSOC); 
        return $data;            
    } else {
        return false;
    }
}
$category = "крипто";

$conn = mysqli_connect("localhost", "root", "", "webproject");

$data =  selectByCategory($category);
echo json_encode($data);
exit();
