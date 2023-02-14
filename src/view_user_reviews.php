<?php
    require_once 'auth_session.php';
    require_once "db.php";
    $db = new Database();
    $userId = 1;
    $query = $db->selectReviewsByUserIdQuery(["userId" => $userId]);
    $result = $query["data"]->fetchAll(PDO::FETCH_ASSOC);
    $questions = array();
    for ($i = 0; $i < sizeof($result) ; $i++ ){
           $questionId = $result[$i]['questionId'];
           $query = $db->selectQuestionTextByIdQuery(["questionId" => $questionId]);
           $data = $query["data"]->fetch(PDO::FETCH_ASSOC);
           $questions[$i] = $data['questiontext'];
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta chareset="utf-8"/>
    <script defer src="../scripts/sendRequestUtility.js"></script>
    <script defer src="../scripts/manageQuestions.js"></script>
    <link rel="stylesheet" href="../styles/index.css"/>
    <title>Your reviews</title>
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

<h1>Here are your reviews</h1>
<table cellspacing="2" cellpadding="2" borders="1">
        <tr>
            <th>Question Text</th>
            <th>Review</th>
       </tr>
       <?php for ($i = 0; $i < sizeof($result) ; $i++ ){ ?>
        <tr>
            <td><?php echo $questions[$i]['questiontext'] ?></td>
            <td><?php echo $result[$i]['reviewText'] ?></td>   
            
       </tr>

        <?php } ?>

    </table>

    

</body>
</html>