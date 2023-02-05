<?php 
$conn = mysqli_connect("localhost", "root", "", "webproject") ;
$result = mysqli_query($conn, "SELECT * FROM questions");
$connect = new PDO('mysql:host=localhost;dbname=webproject','root','');
if(isset($_GET['action']) && $_GET['action'] == 'delete'){
echo $_GET['questiontext'];    
$stmt = $connect->prepare('delete from questions where questiontext = :questiontext');
$stmt->bindValue('questiontext',$_GET['questiontext']);
$stmt->execute();
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div>
    <table cellspacing="2" cellpadding="2" borders="1">
        <tr>
            <th>Question Text</th>
            <th>Answer1</th>
            <th>Answer2</th>
            <th>Answer3</th>
            <th>Answer4</th>
            <th>Answer5</th>
            <th>Answer6</th>
            <th>Correct</th>
            <th>Category</th>
       </tr>
       <?php foreach($result as $question){ ?>
        <tr>
            <td><?php echo $question['questiontext'] ?></td>
            <td><?php echo $question['answer1'] ?></td>
            <td><?php echo $question['answer2'] ?></td>
            <td><?php echo $question['answer3'] ?></td>
            <td><?php echo $question['answer4'] ?></td>
            <td><?php echo $question['answer5'] ?></td>
            <td><?php echo $question['answer6'] ?></td>
            <td><?php echo $question['correctAnswer'] ?></td>
            <td><?php echo $question['category'] ?></td>
            <td>
                <a onclick="" class="delete-button" href="show_questions.php?questiontext=<?php
                 echo $question['questiontext'] ?>&action=delete">DELETE</a>
            </td>    
            
       </tr>

        <?php } ?>

    </table>   
  
</div>
</body>
</html>