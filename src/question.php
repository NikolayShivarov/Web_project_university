<?php
    require_once "db.php";
    
    class Question {
        private $question;
        private $answers;
        private $correctAnswerIndex;
        private $category;
        private $db;

        public function __construct($arr) {
            $this->question = $arr[0];
            $this->answers = array();
            for ($i = 0; $i <= 5; $i++) {
                $this->answers[$i] = $arr[$i + 1]; 
              }
            $this->correctAnswerIndex = $arr[7];
            $this->category = $arr[8];
            $this->db = new Database();
        }

        public function getQuestion() {
            return $this->question;
        }

        public function getAnswers() {
            return $this->answers;
        }

        public function getCorrect() {
            return $this->correctAnswerIndex;
        }

        public function isCorrect($index){
            return $index == $this->correctAnswerIndex;
        }

        public function addQuestionToDatabase() {
            $query = $this->db->insertQuestionQuery(['questiontext' => $this->question, 'answer1' => $this->answers[0],'answer2' => $this->answers[1],'answer3' => $this->answers[2],'answer4' => $this->answers[3],'answer5' => $this->answers[4],'answer6' => $this->answers[5],'correctAnswer' => $this->correctAnswerIndex,'category' => $this->category]);
        }
    }
?>