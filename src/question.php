<?php
    require_once "db.php";
    
    class Question {
        private $question;
        private $answers;
        private $correctAnswerIndex;
        private $category;
        private $difficulty;
        private $fn;
        private $correctfeedback;
        private $wrongfeedback;
        private $db;

        public function __construct($arr) {
            $this->fn = $arr[1];
            $this->question = $arr[4];
            $this->answers = array();
            for ($i = 0; $i <= 3; $i++) {
                $this->answers[$i] = $arr[$i + 5]; 
              }
            $this->correctAnswerIndex = intval($arr[9]) - 1;
            $this->category = $arr[14];
            $this->difficulty = $arr[10];
            $this->correctfeedback = $arr[11];
            $this->wrongfeedback = $arr[12];
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
            $query = $this->db->insertQuestionQuery(['questiontext' => $this->question, 'answer1' => $this->answers[0],'answer2' => $this->answers[1],'answer3' => $this->answers[2],'answer4' => $this->answers[3],'correctAnswer' => $this->correctAnswerIndex,'fn' => $this->fn,'correctfeedback' => $this->correctfeedback,'wrongfeedback' => $this->wrongfeedback  ,'category' => $this->category, 'difficulty' => $this->difficulty ]);
            $query = $this->db->selectMaxIdQuery();
            $data = $query["data"]->fetch(PDO::FETCH_ASSOC);
            $id = $data['max_id'];
            $query = $this->db->insertStatisticQuery(['id' => $id]);
        }
    }
?>