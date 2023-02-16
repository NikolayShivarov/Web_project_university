function Question(questionText, answers, correctIndex, category, correctFeedback, wrongFeedback, questionId, fn){
    this.questionText = questionText;
    this.answers = answers;
    this.correctIndex = correctIndex;
    this.category = category;
    this.correctFeedback = correctFeedback;
    this.wrongFeedback = wrongFeedback;
    this.questionId = questionId;
    this.fn = fn;
  
  }

  var questions = [];

function load(data){
  for(var i = 0; i < data.length; i++) {
    var question = data[i].questiontext;
    const answers = [];
    answers[0] = data[i].answer1;
    if(data[i].answer2.length > 0) answers[1] = data[i].answer2;
    if(data[i].answer3.length > 0) answers[2] = data[i].answer3;
    if(data[i].answer4.length > 0) answers[3] = data[i].answer4;
    var correctIndex = parseInt(data[i].correctAnswer);
    var category = data[i].category;
    var correctFeedback = data[i].correctfeedback;
    var wrongFeedback = data[i].wrongfeedback;
    var questionId = data[i].id;
    var fn = data[i].fn;
    q = new Question(question, answers, correctIndex ,category, correctFeedback, wrongFeedback, questionId, fn);
    questions[i]=q; 
    console.log(questions[i]);
  }
}

function handleError(data){

}

var fnNum = localStorage.getItem("fnNum");
var maxQ = localStorage.getItem("maxQ");
var dificulty = localStorage.getItem("dificulty");

var rev = {
  'fnNum': fnNum,
  'maxQ': maxQ,
  'dificulty': dificulty
};

if(fnNum === undefined || fnNum === 'All'){
  sendRequest('./src/generate_test.php', { method: 'GET', data: `category=All` }, load, handleError);
}else{
  sendRequest('./src/generate_special_test.php', { method: 'POST', data: `data=${JSON.stringify(rev)}` }, load, handleError);
}