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
    
<form>
    <select id="test_fn" onchange="getSelectedCategory();">
        <option value="All" selected>All</option>
    </select>
    <div class = "centered">
        <label for="ratenum1">Choose max questions</label>
        <input id="ratenum1" type="number" step="1" min="1" max="100" value="10" required/>
    </div>  
    <div class = "centered">
        <label for="ratenum2">Choose dificulty between 1 and 5</label>
        <input id="ratenum2" type="number" step="1" min="1" max="5"  value="1" required/>
    </div>  
    <button id="start_test_button" class="smallspecialbutton" type ="submit" value = "Click">Start Test</button>
</form>


  
</div>
</body>
</html>