function Question(questionText, answers, correctIndex, category){
  this.questionText = questionText;
  this.answers = answers;
  this.correctIndex = correctIndex;
  this.category = category;


}

const question = new Question("koy e shefa na spidi", ["Gto", "tosho", "Ivan", "kudin", "krasi"], 2, "hrana");