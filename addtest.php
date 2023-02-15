<?php
    require_once 'src/auth_session.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta chareset="utf-8"/>
    <title>AddTest</title>
    <script defer src="scripts/sendRequestUtility.js"></script>
    <script defer src="scripts/navbar.js"></script>
    <script defer src="scripts/logout.js"></script>
    <link rel="stylesheet" href="styles/index.css"/>
</head>
<body>
    <header>
        <ul id = "nav">
          <li><button class="smallspecialbutton" id="logout">Logout</button></li>
          <li><a href="index.php">Home</a></li>
          <li><a href="test_menu.php">Test menu</a></li>
          <li><a href="src/view_user_reviews.php">Your reviews</a></li>
        </ul> 
    </header>

<h1>Adding a CSV Test:</h1>
    <form action="src/add_test.php" method="POST" enctype="multipart/form-data">
        <!--our custom file upload button-->   
        <input id="actual-btn" type="file" name="filename"  hidden/>
        <label for="actual-btn" class="specialbutton" >Choose File</label>
        <!-- <input id="actual-btn" type="file" name="filename"  /> -->
        <input class="specialbutton" type="submit" value="Upload" />
    </form>

</body>
</html>