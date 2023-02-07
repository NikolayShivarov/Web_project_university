function Question(questionText, answers, correctIndex, category){
    this.questionText = questionText;
    this.answers = answers;
    this.correctIndex = correctIndex;
    this.category = category;
  
  
  }

  var category = localStorage.getItem("textvalue");

  console.log(category);
  var ajax = new XMLHttpRequest();
  if(category == "All") { 
    ajax.open("GET", "src/generate_test.php", true);
}else{
     ajax.open("GET", "src/generate_category_test.php", true);
  }
  ajax.send();
  var questions = [];
  
  ajax.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {  
        var data = JSON.parse(this.responseText);
          console.log(data);   
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