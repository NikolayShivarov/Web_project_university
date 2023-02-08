<?php
    require_once 'src/auth_session.php';
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8" />
  <title>Demo</title>
  <script defer src="scripts/sendRequestUtility.js"></script>
  <script defer src="scripts/index.js"></script>
  <script defer src="scripts/logout.js"></script>
  <link rel="stylesheet" href="styles/index.css"/> 
</head>

<body>
  <header>
    <ul>
      <li><button id="logout">Logout</button></li>
      <li><a class="active" href="index.php">Home</a></li>
      <li><a href="addtest.php">Import Questions</a></li>
      <li><a href="#contact">Export Questions</a></li>
      <li><a href="./src/show_questions.php">Manage questions</a></li>
      <li><a href="test_menu.php">Test menu</a></li>
    </ul> 
  </header>
  
</body>
</html>
