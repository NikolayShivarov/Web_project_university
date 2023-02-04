function Question(questionText, answers, correctIndex, category){
  this.questionText = questionText;
  this.answers = answers;
  this.correctIndex = correctIndex;
  this.category = category;


}

//const question = new Question("koy e shefa na spidi", ["Gto", "tosho", "Ivan", "kudin", "krasi"], 2, "hrana");




    var ajax = new XMLHttpRequest();
    ajax.open("GET", "src/generate_test.php", true);
    ajax.send();
    var questions = [];

    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);


            var html = "";
            
            for(var i = 0; i < data.length; i++) {
                var question = data[i].questiontext;
                const answers = [];
                answers[0] = data[i].answer1;
                if(data[i].answer2.length > 0) answers[1] = data[i].answer2;
                if(data[i].answer3.length > 0) answers[2] = data[i].answer3;
                if(data[i].answer4.length > 0) answers[3] = data[i].answer4;
                if(data[i].answer5.length > 0) answers[4] = data[i].answer5;
                if(data[i].answer6.length > 0) answers[5] = data[i].answer6;
                var correctIndex = parseInt(data[i].correctAnswer);
                var category = data[i].category;
                q = new Question(question, answers, correctIndex ,category);
                questions[i]=q; 
                console.log(questions[i]);
                // var answer2 = data[i].answer2;
                // var answer3 =data[i].answer3;
                // var answer4 = questions[i].answer4;
                // var category = questions[i].category;

                // html += "<tr>";
                //     html += "<td>" + question1 + "</td>";
                //     html += "<td>" + answer1 + "</td>";
                //     html += "<td>" + answer2 + "</td>";
                //     html += "<td>" + answer3 + "</td>";
                //     html += "<td>" + answer4 + "</td>";
                //     html += "<td>" + category + "</td>";
                // html += "</tr>";
            }

        }
    };
   
    console.log(questions[1]);
    console.log(questions);
    //console.log(questions[1].questionText);
    //questions[0] = new Question("koy e shefa na spidi", ["Gto", "tosho", "Ivan", "kudin", "krasi"], 2, "hrana");
    
   function startQuiz() {
  
    var questionArea = document.getElementsByClassName('questions')[0],
        answerArea   = document.getElementsByClassName('answers')[0],
        checker      = document.getElementsByClassName('checker')[0],
        current      = 0;
    
       // An object that holds all the questions + possible answers.
       // In the array --> last digit gives the right answer position
        
        //  {
        //   'What is Canada\'s national animal?' : ['Beaver', 'Duck', 'Horse', 0],
          
        //   'What is converted into alcohol during brewing?' : ['Grain', 'Sugar' , 'Water', 1],
          
        //   'In what year was Prince Andrew born? ' : ['1955', '1960', '1970', 1]
        // };
        
    function loadQuestion(curr) {
    // This function loads all the question into the questionArea
    // It grabs the current question based on the 'current'-variable
    
      var question = questions[curr].questionText;
      
      questionArea.innerHTML = '';
      questionArea.innerHTML = question;    
    }
    
    function loadAnswers(curr) {
    // This function loads all the possible answers of the given question
    // It grabs the needed answer-array with the help of the current-variable
    // Every answer is added with an 'onclick'-function
    
      var answers = questions[curr].answers;
      
      answerArea.innerHTML = '';
      
      for (var i = 0; i < answers.length -1; i += 1) {
        var createDiv = document.createElement('div'),
            text = document.createTextNode(answers[i]);
        
        createDiv.appendChild(text);      
        createDiv.addEventListener("click", checkAnswer(i,curr));
        
        
        answerArea.appendChild(createDiv);
      }
    }
    
    function checkAnswer(i,curr) {
      // This is the function that will run, when clicked on one of the answers
      // Check if givenAnswer is sams as the correct one
      // After this, check if it's the last question:
      // If it is: empty the answerArea and let them know it's done.
      
      return function () {
        var givenAnswer = i,
            correctAnswer = questions[curr].correctIndex;
        
        if (givenAnswer === correctAnswer) {
          addChecker(true);             
        } else {
          addChecker(false);                        
        }
        
        if (current < questions.length -1) {
          current += 1;
          
          loadQuestion(current);
          loadAnswers(current);
        } else {
          questionArea.innerHTML = 'Done';
          answerArea.innerHTML = '';
        }
                                
      };
    }
    
    function addChecker(bool) {
    // This function adds a div element to the page
    // Used to see if it was correct or false
    
      var createDiv = document.createElement('div'),
          txt       = document.createTextNode(current + 1);
      
      createDiv.appendChild(txt);
      
      if (bool) {
        
        createDiv.className += 'correct';
        checker.appendChild(createDiv);
      } else {
        createDiv.className += 'false';
        checker.appendChild(createDiv);
      }
    }
    
    
    // Start the quiz right away
    loadQuestion(current);
    loadAnswers(current);
    
  };

  window.setTimeout(startQuiz,500);