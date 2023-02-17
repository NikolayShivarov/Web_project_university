<?php
    require_once './auth_session.php';
    require_once "./db.php";
    $db = new Database();
    $userId = $_SESSION['userId'];
    $_SESSION['questionId'] = $_GET['questionId'];
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

<form action="updateReview2.php" name = "updateR"  method="post">
Review: <input type="text" name="reviewText"><br>
<input type = "submit"  value="Update review">
</form>


    

</body>
</html>