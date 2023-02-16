
<?php
require_once 'db.php';


// function selectByCategory($category) {
//     $db= new Database();
//     $query = $db->selectQuestionsByCategoryQuery(["category" => $category]);
    
//     if ($query["success"]) {
//         $data = array();
//         $data = $query["data"]->fetchAll(PDO::FETCH_ASSOC); 
//         return $data;            
//     } else {
//         return false;
//     }
// }
$fnNum;
$maxQ;
$dificulty;
$query;

$db = new Database();

if ($_POST) {
    $data = json_decode($_POST['data'], true);
    $fnNum = $data['fnNum'];
    $maxQ = $data['maxQ'];
    $dificulty = $data['dificulty'];
}

if($fnNum == "All"){
    $query = $db->selectAllQuestionsQuery();
}else{
    $query = $db->selectQuestionsByFnQuery(['fn' => $fnNum]);
}

$result = $query["data"]->fetchAll(PDO::FETCH_ASSOC);
$g = 0;
$resArr = array();
for($i = 0;$i < sizeof($result);$i++){
    if($result[$i]['difficulty'] == $dificulty){
        $resArr[$g] = $result[$i];
        $g++;
    }
    if($g == $maxQ){
        break;
    }
} 

echo json_encode($resArr);
exit(); ?>

