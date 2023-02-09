<?php 
require_once "db.php";
// $conn = mysqli_connect("localhost", "root", "", "webproject") ;
// $result = mysqli_query($conn, "SELECT distinct category FROM questions");
// $data = array();
// while ($row = mysqli_fetch_object($result))
// {
//     array_push($data, $row);
// }

$db = new Database();
$query = $db->selectCategoriesQuery();
$data = $query['data']->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);
exit();

?>





