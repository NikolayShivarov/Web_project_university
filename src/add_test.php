<?php
  require_once "db.php";
  require_once "question.php";

$file_extension = explode('.',$_FILES['filename']['name']);
$file_extension = end($file_extension);
//Сheck that we have a file
if((!empty($_FILES["filename"])) && ($_FILES['filename']['error'] == 0)) {
 if($file_extension == 'csv') { 
   $file = fopen($_FILES['filename']['tmp_name'], 'r');
   $arr = fgetcsv($file);

   while($arr = fgetcsv($file,3000,";") ){
       if(sizeof($arr) > 1){
                $currenQuestion = new Question($arr);
                $currenQuestion->addQuestionToDatabase();
       }
                }

  } 
  header("Location: ../addtest.php");
}

?>