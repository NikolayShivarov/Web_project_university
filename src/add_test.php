<?php
  require_once "db.php";
  require_once "question.php";

echo $_FILES['filename']['name'];
$file_extension = explode('.',$_FILES['filename']['name']);
$file_extension = end($file_extension);
//Сheck that we have a file
if((!empty($_FILES["filename"])) && ($_FILES['filename']['error'] == 0)) {
 if($file_extension == 'csv') { 
   $file = fopen($_FILES['filename']['tmp_name'], 'r');
   $arr = fgetcsv($file);
  //  while(! feof($file)) {
  //   $line = fgetcsv($file);
  //   echo $line. "<br>";
  //   }
   while($arr = fgetcsv($file) ){
       if(sizeof($arr) != 1){
                print_r($arr);
                echo count($arr);
                $currenQuestion = new Question($arr);
                $currenQuestion->addQuestionToDatabase();
       }
                }

  } else {
     echo "Error: Only csv files are accepted for upload";
  }
}
  else {
 echo "No file uploaded";
} 

?>