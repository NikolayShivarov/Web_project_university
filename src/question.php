<?php
    class Question {
        public $question;
        public $answers;
        public $correctAnswerIndex;

        public function __construct($arr) {
            $this->question = $arr[0];
            $this->answers = array();
            for ($i = 0; $i <= 5; $i++) {
                $this->answers[$i] = $arr[$i + 1]; 
              }
            $this->correctAnswerIndex = $arr[7];
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
    }
?>