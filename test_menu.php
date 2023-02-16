<?php
    require_once 'src/auth_session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta chareset="utf-8"/>
    <script defer src="scripts/sendRequestUtility.js"></script>
    <script defer src="scripts/navbar.js"></script>
    <script defer src="scripts/selectTest.js"></script>
    <script defer src="scripts/logout.js"></script>
    <link rel="stylesheet" href="styles/index.css"/>
    <title>Test menu</title>
</head>
<body>
<header>
        <ul id = "nav">
          <li><button class="smallspecialbutton" id="logout">Logout</button></li>
          <li><a href="index.php">Home</a></li>
          <li><a class="active" href="test_menu.php">Test menu</a></li>
          <li><a href="src/view_user_reviews.php">Your reviews</a></li>
        </ul> 
        <h1>Choose test</h1>
</header>
<body>   
<div>
    
<form></form>
<select id="test_fn" onchange="getSelectedCategory();">
    <option value="All" selected>All</option>
</select>
<button id="start_test_button" type ="submit" value = "Click" onclick ="passValue()" >Start Test</button>



  
</div>
</body>
</html>