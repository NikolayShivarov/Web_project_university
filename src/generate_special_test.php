
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
$g = 0;
$resArr = array();
if ($dificulty!=0){
$result = $query["data"]->fetchAll(PDO::FETCH_ASSOC);
for($i = 0;$i < sizeof($result);$i++){
    if($result[$i]['difficulty'] == $dificulty){
        $resArr[$g] = $result[$i];
        $g++;
    }
}
}
else{
    $resArr = $query["data"]->fetchAll(PDO::FETCH_ASSOC); 
}
$g=0;

if(sizeof($resArr) <= $maxQ) echo json_encode($resArr);
else{
    $isIn = array();
    for($i = 0; $i < sizeof($resArr); $i++) $isIn[$i] = 0;
    $randArr = array();
    while($g < $maxQ){
        $r = rand(0,sizeof($resArr)-1);
        while($isIn[$r] == 1) $r = rand(0,sizeof($resArr)-1);
        $randArr[$g] = $resArr[$r];
        $isIn[$r] = 1;
        $g++;

    }
    echo json_encode($randArr);

}
exit(); ?>

