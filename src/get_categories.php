<?php 
require_once "db.php";
$db = new Database();
$query = $db->selectCategoriesQuery();
$data = $query['data']->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);
exit();

?>





