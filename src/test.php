<?php
    require_once "question.php";
    require_once "test.csv";

    $file = fopen("test.csv","r");



    class Test{
        public $questions;
        public $name;

        public function __construct($name) {
            $this->name=$name; 
            $this->questions = array();
            $i = 0;
            global $file;
            $arr= array();
            $arr = fgetcsv($file);
            print_r($arr);
            $i=0;
            while($arr = fgetcsv($file)){
                print_r($arr);
                $currenQuestion = new Question($arr);
                echo $currenQuestion->answers[0];
                $this->questions[$i] =  new Question($arr);
                $i+= 1;
              
                }
        }

    }

    $test = new Test("ugabuga");
    echo $test->name;
    echo $test->questions[0]->question;
    echo $test->questions[0]->answers[0];
    print_r($test);
    
    

    fclose($file);
?>
