<?php
// require_once 'question.php';

// header('Content-type: application/json');

// $questions = array();
// $arr = array('koy e shefa na spidi', 'ivan', 'gto', 'gosho', 'tosho', '' , '' , 0 , 'hrana'); 
// $questions[0] = new Question($arr);  
// $arr2 = array('koy e shefa na uncle', 'ivan', 'gto', 'gosho', 'tosho', '' , '' , 1 , 'hrana');
// $questions[1] = new Question($arr2);
// echo json_encode($questions);

$conn = mysqli_connect("localhost", "root", "", "webproject");
$result = mysqli_query($conn, "SELECT * FROM questions");

$data = array();
while ($row = mysqli_fetch_object($result))
{
    array_push($data, $row);
}

echo json_encode($data);
exit();