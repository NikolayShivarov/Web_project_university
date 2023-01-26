<!DOCTYPE html>
<html>
<head>
<title>Добавяне на тест</title>
</head>
<body>
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
   while($arr = fgetcsv($file)){
                $currenQuestion = new Question($arr);
                $currenQuestion->addQuestionToDatabase();
                }

  } else {
     echo "Error: Only csv files are accepted for upload";
  }
}
  else {
 echo "No file uploaded";
} 

?>
<h1>Добавяне на тест</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="filename"  />
        <input type="submit" value="Upload" />
      </form>

</body>
</html>