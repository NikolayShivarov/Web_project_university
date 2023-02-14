<?php
    require_once 'auth_session.php';
    require_once "db.php";
    $db = new Database();
    $questionId = 1;
    $query = $db->selectQuestionByIdQuery(["id" => $questionId]);
    $result = $query["data"]->fetch(PDO::FETCH_ASSOC);


    $query = $db->selectReviewsByQuestionIdQuery(["questionId" => $questionId]);
    $reviews = $query["data"]->fetchAll(PDO::FETCH_ASSOC); 

    $usernames = array();

    for ($i = 0; $i < sizeof($reviews) ; $i++ ){
           $userId = $reviews[$i]['userId'];
           $query = $db->selectUserByIdQuery(["id" => $userId]);
           $data = $query["data"]->fetch(PDO::FETCH_ASSOC);
           $usernames[$i] = $data['username'];
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta chareset="utf-8"/>
    <script defer src="../scripts/sendRequestUtility.js"></script>
    <script defer src="../scripts/manageQuestions.js"></script>
    <link rel="stylesheet" href="../styles/index.css"/>
    <title>Question info</title>
</head>
<body>
<header>
        <ul>
          <li><button id="../logout">Logout</button></li>
          <li><a href="../index.php">Home</a></li>
          <li><a  href="../addtest.php">Import Questions</a></li>
          <li><a href="#contact">Export Questions</a></li>
          <li><a class="active" href="show_questions.php">Manage questions</a></li>
          <li><a href="../test_menu.php">Test menu</a></li>
        </ul> 
</header>  

<h1>Here is the question information</h1>
<table cellspacing="2" cellpadding="2" borders="1">
        <tr>
            <th>Question Text</th>
            <th>Answer1</th>
            <th>Answer2</th>
            <th>Answer3</th>
            <th>Answer4</th>
            <th>Difficulty</th>
            <th>fn</th>
            <th>Correct</th>
            <th>Category</th>
            <th>correctfeedback</th>
            <th>wrongfeedback</th>

       </tr>
        <tr>
            <td><?php echo $result['questiontext'] ?></td>
            <td><?php echo $result['answer1'] ?></td>
            <td><?php echo $result['answer2'] ?></td>
            <td><?php echo $result['answer3'] ?></td>
            <td><?php echo $result['answer4'] ?></td>
            <td><?php echo $result['difficulty'] ?></td>
            <td><?php echo $result['fn'] ?></td>
            <td><?php echo $result['correctAnswer'] ?></td>
            <td><?php echo $result['category'] ?></td>
            <td><?php echo $result['correctfeedback'] ?></td>
            <td><?php echo $result['wrongfeedback'] ?></td>         
       </tr>

    </table>

    <h1>Here are the question reviews</h1>
<table cellspacing="2" cellpadding="2" borders="1">
        <tr>
            <th>User</th>
            <th>Review</th>
       </tr>
       <?php for ($i = 0; $i < sizeof($reviews) ; $i++ ){ ?>
        <tr>
            <td><?php echo $usernames[$i] ?></td>
            <td><?php echo $result[$i]['reviewText'] ?></td>   
            
       </tr>

        <?php } ?>

    </table>
    
    

</body>
</html>