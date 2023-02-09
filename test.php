<?php
    require_once 'src/auth_session.php';
?>

<!DOCTYPE html>

<html>
    <head>
        <meta chareset="utf-8"/>

        <title>Test</title>

        <script defer src="scripts/sendRequestUtility.js"></script>
        <script defer src="scripts/question.js"></script>
        <script defer src="scripts/testMaker.js"></script>
        <script defer src="scripts/index.js"></script>
        <link rel="stylesheet" href="styles/style.css"/>
        <link rel="stylesheet" href="styles/index.css"/>
    </head>

    <body>
        <ul>
          <li><a href="index.">Home</a></li>
          <li><a href="addtest.php">Import Questions</a></li>
          <li><a href="#contact">Export Questions</a></li>
          <li><a href="src/show_questions.php">Manage questions</a></li>
          <li><a class="active" href="test_menu.php">Test menu</a></li>
        </ul> 
        <main>
            <div class="wrapper">
                <div id="quiz">
                  <h1>Question:<text id="counter">1</text></h1>
                  
                  <p class="questions"></p>
                  
                  <div class="answers"></div>         
                  <div id="last_question">
                    <img id="left_a" src="img/arrow_left.png" class="arrow" >
                  </div>
                  <div id="next_question">
                    <img id="right_a" src="img/arrow_right.png" class="arrow" >
                  </div>
                  <button id="finish" class="specialbutton">Finish</button>
                  <div class="checkAnswers">
                    <h3>Correct?</h3>
                    
                    <div class="checker">
            
                    </div>
                  </div>
                  <!-- <button id="last_question" class="specialbutton">
                      <img   class="left_a" src="img/arrow_left.png" class="arrow" >
                  </button>
                  <button id="next_question" class="specialbutton">
                      <img  class="right_a" src="img/arrow_right.png" class="arrow" >
                  </button> -->
                  
                         
                </div> 
              </div>  
                    
        </main>
    </body>

</html>