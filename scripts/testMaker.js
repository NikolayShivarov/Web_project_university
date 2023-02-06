function startQuiz() {

  var questionArea = document.getElementsByClassName('questions')[0];
  var answerArea   = document.getElementsByClassName('answers')[0];
  var checker      = document.getElementsByClassName('checker')[0];
  var arrowLeft    = document.getElementById('last_question');
  var arrowRight   = document.getElementById('next_question');
  var finishButton = document.getElementById('finish');
  var counter      = document.getElementById('counter');
  var current      = 0;
  var answeredQuestions = [];
  
  arrowLeft.addEventListener("click",loadPrev());
  arrowRight.addEventListener("click",loadNext());
  finishButton.addEventListener("click",finish());

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
  
  function loadQuestion() {
  // This function loads all the possible answers of the given question
  // It grabs the needed answer-array with the help of the current-variable
  // Every answer is added with an 'onclick'-function
    var question = questions[current].questionText;
    var answers = questions[current].answers;

    counter.innerHTML = current + 1;
    questionArea.innerHTML = '';
    questionArea.innerHTML = question;   
    answerArea.innerHTML = '';
    
    for (var i = 0; i < answers.length; i += 1) {
      var createDiv = document.createElement('div');

      createDiv.addEventListener("click", checkAnswer(i));
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
  
  function checkAnswer(i) {
    return function () {
      answeredQuestions[current] = i;                  
    };
  }

  function finish(){
    return function () {
      var sum = 0;
      var all = questions.length;

      for(var i = 0;i < questions.length; i += 1){
        var createDiv = document.createElement('div');
        var txt = document.createTextNode(i + 1);
        createDiv.appendChild(txt);
        if(answeredQuestions[i] === undefined){
          createDiv.className += 'false';
          checker.appendChild(createDiv);
        }else{
          if (answeredQuestions[i] === questions[i].correctIndex){
            createDiv.className += 'correct';
            checker.appendChild(createDiv);
          }else{
            createDiv.className += 'false';
            checker.appendChild(createDiv);
          }
        }
      }
    };
  }
  
  // Start the quiz right away
  loadQuestion(current);
};

window.setTimeout(startQuiz,500);