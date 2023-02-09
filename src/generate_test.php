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

// $conn = mysqli_connect("localhost", "root", "", "webproject");
// $result = mysqli_query($conn, "SELECT * FROM questions");

// $data = array();
// while ($row = mysqli_fetch_object($result))
// {
//     array_push($data, $row);
// }
$data = selectAll();

echo json_encode($data);
exit();

?>