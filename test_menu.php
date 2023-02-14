<?php
    require_once 'src/auth_session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta chareset="utf-8"/>
    <script defer src="scripts/sendRequestUtility.js"></script>
    <script defer src="scripts/selectTest.js"></script>
    <script defer src="scripts/logout.js"></script>
    <link rel="stylesheet" href="styles/index.css"/>
    <title>Test menu</title>
</head>
<body>
<header>
        <ul>
          <li><button id="logout">Logout</button></li>
          <li><a href="index.php">Home</a></li>
          <li><a  href="addtest.php">Import Questions</a></li>
          <li><a href="#contact">Export Questions</a></li>
          <li><a href="show_questions.php">Manage questions</a></li>
          <li><a class="active" href="test_menu.php">Test menu</a></li>
        </ul> 
        <h1>Choose test</h1>
</header>
<body>   
<div>
    

<select id="test_selection" onchange="getSelectedCategory();">
    <option value="All" selected>All</option>
</select>
<button id="start_test_button" type ="submit" value = "Click" onclick ="passValue()" >Start Test</button>



  
</div>
</body>
</html>