function Question(questionText, answers, correctIndex, category){
  this.questionText = questionText;
  this.answers = answers;
  this.correctIndex = correctIndex;
  this.category = category;


}

const question = new Question("koy e shefa na spidi", ["Gto", "tosho", "Ivan", "kudin", "krasi"], 2, "hrana");


// var questions = fetch("src/generate_test.php")
//         .then((response) => {
//             if(!response.ok){ // Before parsing (i.e. decoding) the JSON data,
//                               // check for any errors.
//                 // In case of an error, throw.
//                 throw new Error("Something went wrong!");
//             }

//             return response.json(); // Parse the JSON data.
//         }).then((data) => {
//              // This is where you handle what to do with the response.
//               // Will alert: 42
              
//               console.log(data);
//         })
//         .catch((error) => {
//              // This is where you handle errors.
//         });
//         console.log(questions);

    var ajax = new XMLHttpRequest();
    ajax.open("GET", "src/generate_test.php", true);
    ajax.send();

    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var questions = JSON.parse(this.responseText);
            console.log(questions);

            var html = "";
            for(var a = 0; a < questions.length; a++) {
                var question1 = questions[a].questiontext;
                var answer1 = questions[a].answer1;
                var answer2 = questions[a].answer2;
                var answer3 = questions[a].answer3;
                var answer4 = questions[a].answer4;
                var category = questions[a].category;

                html += "<tr>";
                    html += "<td>" + question1 + "</td>";
                    html += "<td>" + answer1 + "</td>";
                    html += "<td>" + answer2 + "</td>";
                    html += "<td>" + answer3 + "</td>";
                    html += "<td>" + answer4 + "</td>";
                    html += "<td>" + category + "</td>";
                html += "</tr>";
            }
            document.getElementById("data").innerHTML += html;
        }
    };