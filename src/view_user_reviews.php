<?php
    require_once './auth_session.php';
    require_once "./db.php";
    $db = new Database();
    $userId = $_SESSION['userId'];
    $query = $db->selectReviewsByUserIdQuery(["userId" => $userId]);
    $result = $query["data"]->fetchAll(PDO::FETCH_ASSOC);
    $questions = array();
    $query = $db->selectRatingByUserIdQuery(["userId" => $userId]);
    $ratings = $query["data"]->fetchAll(PDO::FETCH_ASSOC);
    for ($i = 0; $i < sizeof($result) ; $i++ ){
           $questionId = $result[$i]['questionId'];
           $query = $db->selectQuestionTextByIdQuery(["id" => $questionId]);
           $data = $query["data"]->fetch(PDO::FETCH_ASSOC);
           $questions[$i] = $data['questiontext'];
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta chareset="utf-8"/>
    <script defer src="../scripts/sendRequestUtility.js"></script>
    <script defer src="../scripts/navbar2.js"></script>
    <script defer src="../scripts/logout.js"></script>
    <link rel="stylesheet" href="../styles/index.css"/>
    <title>Your reviews</title>
</head>
<body>
<header>
        <ul id = "nav">
          <li><button class="smallspecialbutton" id="logout">Logout</button></li>
          <li><a href="../index.php">Home</a></li>
          <li><a href="../test_menu.php">Test menu</a></li>
          <li><a class="active" href="./view_user_reviews.php">Your reviews</a></li>
        </ul> 
</header>  

<h1>Here are your reviews</h1>
<table cellspacing="2" cellpadding="2" borders="1">
        <tr>
            <th>Question Text</th>
            <th>Review</th>
            <th>Rating</th>
       </tr>
       <?php for ($i = 0; $i < sizeof($result) ; $i++ ){ ?>
        <tr>
            <td><?php echo $questions[$i] ?></td>
            <td><?php echo $result[$i]['reviewText'] ?></td>
            <td><?php echo $ratings[$i]['rating'] ?></td>
            <td>              
            <a onclick="return confirm('Do you want to view this question?');" class="view-button" href="question_info.php?questionId=<?php
                 echo $result[$i]['questionId'] ?>&action=view"><button class="view-btn">VIEW</button></a>
            </td>
            <td>
                <a onclick="return confirm('Do you want to update this review?');" class="delete-button" href="updateReview.php?questionId=<?php
                echo $result[$i]['questionId'] ?>&action=update"><button class="delete-btn">UPDATE</button></a>
            </td>
            
       </tr>

        <?php } ?>

    </table>

    

</body>
</html>