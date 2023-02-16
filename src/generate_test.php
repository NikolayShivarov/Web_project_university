<?php
require_once 'db.php';
function selectAll() {
    $db= new Database();
    $query = $db->selectAllQuestionsQuery();
    
    if ($query["success"]) {
        $data = array();
        $data = $query["data"]->fetchAll(PDO::FETCH_ASSOC); 
        return $data;            
    } else {
        return false;
    }
}

$data = selectAll();

echo json_encode($data);
exit();

?>