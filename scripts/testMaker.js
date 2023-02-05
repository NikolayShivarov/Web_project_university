function Question(questionText, answers, correctIndex, category){
  this.questionText = questionText;
  this.answers = answers;
  this.correctIndex = correctIndex;
  this.category = category;


}

var ajax = new XMLHttpRequest();
ajax.open("GET", "src/generate_test.php", true);
ajax.send();
var questions = [];

ajax.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var data = JSON.parse(this.responseText);

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
        }

    }
};
   
function startQuiz() {

  var questionArea = document.getElementsByClassName('questions')[0];
  var answerArea   = document.getElementsByClassName('answers')[0];
  var checker      = document.getElementsByClassName('checker')[0];
  var arrowLeft    = document.getElementById('last_question');
  var arrowRight   = document.getElementById('next_question');
  var current      = 0;
  var answeredQuestions = [];
  
  arrowLeft.addEventListener("click",loadPrev());
  arrowRight.addEventListener("click",loadNext());

  function loadPrev(){
    return function () {
      if(current > 0){
        current -= 1;
        loadQuestion(current);
      }
    };
  }

  function loadNext(){
    return function () {
      if(current < questions.length - 1){
        current += 1;
        loadQuestion(current);
      }                       
    };
  }
  
  function loadQuestion(curr) {
  // This function loads all the possible answers of the given question
  // It grabs the needed answer-array with the help of the current-variable
  // Every answer is added with an 'onclick'-function
    var question = questions[curr].questionText;
    var answers = questions[curr].answers;

    questionArea.innerHTML = '';
    questionArea.innerHTML = question;   
    answerArea.innerHTML = '';
    
    for (var i = 0; i < answers.length; i += 1) {
      var createDiv = document.createElement('div');

      createDiv.addEventListener("click", checkAnswer(i,curr));
      var label = document.createElement("label");
      label.innerText = answers[i];
      var input = document.createElement("input");
      input.type = "radio";
      input.name = "answers";
      if(answeredQuestions.length >= current && i == answeredQuestions[current]){
        input.checked = true;
      }
      label.appendChild(input);
      label.classList.add("container");
      var span = document.createElement("span");
      span.classList.add("checkmark");
      label.appendChild(span);
      createDiv.appendChild(label);
      answerArea.appendChild(createDiv);
    }
  }
  
  function checkAnswer(i,curr) {
    // This is the function that will run, when clicked on one of the answers
    // Check if givenAnswer is sams as the correct one
    // After this, check if it's the last question:
    // If it is: empty the answerArea and let them know it's done.
    
    return function () {
      //var givenAnswer = i;
      //var correctAnswer = questions[curr].correctIndex;
      answeredQuestions[current] = i; 
      // if (givenAnswer === correctAnswer) {
      //   addChecker(true);             
      // } else {
      //   addChecker(false);                        
      // }
      
      // if (current < questions.length -1) {
      //   current += 1;
        
      //   loadQuestion(current);
      //   loadAnswers(current);
      // } else {
      //   questionArea.innerHTML = 'Done';
      //   answerArea.innerHTML = '';
      // }
                              
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
};

window.setTimeout(startQuiz,500);