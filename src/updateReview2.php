<?php
    require_once './auth_session.php';
    require_once "./db.php";
    $db = new Database();
    $userId = $_SESSION['userId'];
    $reviewText = $_POST["reviewText"];
    $questionId = $_SESSION['questionId'];
    $query = $db->updateReviewQuery(["userId" => $userId, "questionId" => $questionId, "reviewText" => $reviewText]);
 
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
<h1>Review changed successfully</h1> 



    

</body>
</html>