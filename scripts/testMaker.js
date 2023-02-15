function startQuiz() {

  var questionArea = document.getElementsByClassName('questions')[0];
  var answerArea   = document.getElementsByClassName('answers')[0];
  var checker      = document.getElementsByClassName('checker')[0];
  var arrowLeft    = document.getElementById('last_question');
  var arrowRight   = document.getElementById('next_question');
  var finishButton = document.getElementById('finish');
  var counter      = document.getElementById('counter');
  var feedbackbtn  = document.getElementById('sendfeedback');
  var ratingbtn  = document.getElementById('sendrating');
  var sendReview   = document.getElementById('sendR');
  var sendRating   = document.getElementById('sendRA');
  var p            = document.getElementById('text2');
  var review       = document.getElementById('freeform');
  var current      = 0;
  var answeredQuestions = [];

  var modal = document.getElementById("popup");
  var modal2 = document.getElementById("popup2");
  var span = document.getElementsByClassName("close")[0];
  var span2 = document.getElementsByClassName("close2")[0];

  feedbackbtn.onclick = function() {
    modal.style.display = "block";
  }

  ratingbtn.onclick = function() {
    modal2.style.display = "block";
  }

  function load(data){
    console.log(data);
  }

  function handleError(){

  }

  sendReview.onclick = function() {

    var text = review.value;

    var rev = {
      'questionId': questions[current].questionId,
      'text': text,
    };

    sendRequest('./src/add_review.php', { method: 'POST', data: `data=${JSON.stringify(rev)}` }, load, handleError);
    modal.style.display = "none";
  }

  sendRating.onclick = function() {

    var text = rating.value;

    var rev = {
      'questionId': questions[current].questionId,
      'text': text,
    };

    sendRequest('./src/add_rating.php', { method: 'POST', data: `data=${JSON.stringify(rev)}` }, load, handleError);
    modal2.style.display = "none";
  }

  span.onclick = function() {
    modal.style.display = "none";
  }

  span2.onclick = function() {
    modal2.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }

    if (event.target == modal2) {
      modal2.style.display = "none";
    }
  }
  
  arrowLeft.addEventListener("click",loadPrev);
  arrowRight.addEventListener("click",loadNext);
  finishButton.addEventListener("click",finish());
  finishButton.style.visibility = "hidden";
  feedbackbtn.style.visibility = "hidden";
  ratingbtn.style.visibility = "hidden";

  function loadPrev(){
      if(current > 0){
        current -= 1;
        loadQuestion(current);
      }
  }

  function loadNext(){
      if(current < questions.length - 1){
        current += 1;
        loadQuestion(current);
      }                       
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
    
    if(questions.length - 1 == current){
      finishButton.style.visibility = "visible";
    }else{
      finishButton.style.visibility = "hidden";
    }

  }
  
  function checkAnswer(i) {
    return function () {
      answeredQuestions[current] = i;                  
    };
  }

  function loadPrevM(){
      if(current > 0){
        current -= 1;
        loadQuestionReview(current);
      }
  }

  function loadNextM(){
      if(current < questions.length - 1){
        current += 1;
        loadQuestionReview(current);
      }                       
  }

  function loadQuestionReview(){
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
      var label = document.createElement("label");
      label.innerText = answers[i];
      var input = document.createElement("input");
      input.type = "radio";
      input.name = "answers";
      if(answeredQuestions.length >= current && i == answeredQuestions[current]){
        input.checked = true;
      }

      if(questions[current].correctIndex === i){
        label.className = "correct";
      }

      if(i === answeredQuestions[current] && questions[current].correctIndex === i){
        label.className = "correct";
      }else if (i === answeredQuestions[current] && questions[current].correctIndex != i){
        label.className = "false";
      }

      input.disabled = true;
      label.appendChild(input);
      label.classList.add("container");
      var span = document.createElement("span");
      span.classList.add("checkmark");
      span.disabled = true;
      label.appendChild(span);
      createDiv.appendChild(label);
      answerArea.appendChild(createDiv);
    }
    
    if(answeredQuestions[current] === undefined){
      p.innerHTML = "You have not answered! " + questions[current].wrongFeedback;
    }else if (answeredQuestions[current] === questions[current].correctIndex){
      p.innerHTML = questions[current].correctFeedback;
    }else{
      p.innerHTML = questions[current].wrongFeedback;
    }

  }
  

  function finish(){
    return function () {
    
      finishButton.style.visibility = "hidden";
      feedbackbtn.style.visibility = "visible";
      ratingbtn.style.visibility = "visible";
      arrowLeft.removeEventListener("click", loadPrev);
      arrowRight.removeEventListener("click", loadNext);
       
      arrowLeft.addEventListener("click",loadPrevM);
      arrowRight.addEventListener("click",loadNextM);

      var sum = 0;
      var all = questions.length;

      for(var i = 0;i < questions.length; i += 1){
        if (answeredQuestions[i] === questions[i].correctIndex){
          sum += 1;
        }
      }

      loadQuestionReview();
    };
  }
  
  // Start the quiz right away
  loadQuestion(current);
};

window.setTimeout(startQuiz,500);