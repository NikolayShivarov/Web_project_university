<?php 
$conn = mysqli_connect("localhost", "root", "", "webproject") ;
$result = mysqli_query($conn, "SELECT * FROM questions");
$connect = new PDO('mysql:host=localhost;dbname=webproject','root','');
if(isset($_GET['action']) && $_GET['action'] == 'delete'){   
$stmt = $connect->prepare('delete from questions where questiontext = :questiontext');
$stmt->bindValue('questiontext',$_GET['questiontext']);
$stmt->execute();



}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta chareset="utf-8"/>
    <script defer src="../scripts/sendRequestUtility.js"></script>
    <link rel="stylesheet" href="../styles/index.css"/>
    <title>Managing questions</title>
</head>
<body>
<header>
        <ul>
          <li><button id="../logout">Logout</button></li>
          <li><a href="../index.html">Home</a></li>
          <li><a  href="../addtest.html">Import Questions</a></li>
          <li><a href="#contact">Export Questions</a></li>
          <li><a href="../test.html">Generate Test</a></li>
          <li><a class="active" href="show_questions.php">Manage questions</a></li>
        </ul> 
</header>   
<div>
    <h1>Manage Questions</h1>
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
                <a onclick="return confirm('Do you want to delete this question?');" class="delete-button" href="show_questions.php?questiontext=<?php
                 echo $question['questiontext'] ?>&action=delete"><button class="delete-btn">DELETE</button></a>
            </td>    
            
       </tr>

        <?php } ?>

    </table>   
  
</div>
</body>
</html>