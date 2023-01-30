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
    let questions = [];

    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            console.log(data);

            var html = "";
            
            for(var i = 0; i < data.length; i++) {
                var question = data[i].questiontext;
                let answers = [];
                if(data[i].answer1.lenght > 0) answers[0] = data[i].answer1;
                if(data[i].answer2.lenght > 0) answers[1] = data[i].answer2;
                if(data[i].answer3.lenght > 0) answers[2] = data[i].answer3;
                if(data[i].answer4.lenght > 0) answers[3] = data[i].answer4;
                if(data[i].answer5.lenght > 0) answers[4] = data[i].answer5;
                if(data[i].answer6.lenght > 0) answers[5] = data[i].answer6;
                correctIndex = data[i].correctAnswer;
                category = data[i].category;
                questions[i] = new Question(question, answers, correctIndex ,category); 
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
            document.getElementById("data").innerHTML += html;
        }
    };