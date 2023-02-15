<?php
    require_once 'src/auth_session.php';
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8" />
  <title>Demo</title>
  <script defer src="scripts/sendRequestUtility.js"></script>
  <script defer src="scripts/navbar.js"></script>
  <script defer src="scripts/index.js"></script>
  <script defer src="scripts/logout.js"></script>
  <link rel="stylesheet" href="styles/index.css"/> 
</head>

<body>
  <header>
    <ul id = "nav">
      <li><button class="smallspecialbutton" id="logout">Logout</button></li>
      <li><a class="active" href="index.php">Home</a></li>
      <li><a href="test_menu.php">Test menu</a></li>
      <li><a href="src/view_user_reviews.php">Your reviews</a></li>
    </ul> 
  </header>
  
</body>
</html>
