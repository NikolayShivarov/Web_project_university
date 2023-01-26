<?php
    require_once "question.php";
    require_once "test.csv";

    $file = fopen("test.csv","r");



    class Test{
        public $questions;
        public $name;

        public function __construct($name, $file) {
            $this->name=$name; 
            $this->questions = array();
            $i = 0;
            // global $file;
            $arr= array();
            $arr = fgetcsv($file);
            $i=0;
            while($arr = fgetcsv($file)){
                $currenQuestion = new Question($arr);
                $this->questions[$i] =  new Question($arr);
                $i+= 1;
                }
        }

    }

   /* $test = new Test("ugabuga");
    echo $test->name;
    echo $test->questions[0]->question;
    echo $test->questions[0]->answers[0];
    print_r($test);
    
    

    fclose($file); */
?>
