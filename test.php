<?php
    require_once 'src/auth_session.php';
?>

<!DOCTYPE html>

<html>
    <head>
        <meta chareset="utf-8"/>

        <title>Test</title>

        <script defer src="scripts/sendRequestUtility.js"></script>
        <script defer src="scripts/navbar.js"></script>
        <script defer src="scripts/question.js"></script>
        <script defer src="scripts/testMaker.js"></script>
        <script defer src="scripts/index.js"></script>
        <link rel="stylesheet" href="styles/style.css"/>
        <link rel="stylesheet" href="styles/index.css"/>
    </head>

    <body>
        <ul id = "nav">
          <li><button class="smallspecialbutton" id="logout">Logout</button></li>
          <li><a href="index.php">Home</a></li>
          <li><a class="active" href="test_menu.php">Test menu</a></li>
          <li><a href="src/view_user_reviews.php">Your reviews</a></li>
        </ul> 
        <main>
          <div class="wrapper">
            <div id="quiz">
              <h1>Question:<text id="counter">1</text></h1>
              
              <p class="questions"></p>
              
              <div class="answers"></div>         
              <div class="left_a">
                <button id="last_question" class="smallspecialbutton">
                    Prev
                </button>
              </div>
              <div class="right_a">
                <button id="next_question" class="smallspecialbutton">
                    Next
                </button>
              </div>
              <button id="finish" class="specialbutton">Finish</button>
              <div id="feedback">
                <p id="text2"></p>
                
              </div>                    
            </div> 
          </div>        
        </main>
    </body>

</html>