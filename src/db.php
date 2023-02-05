<?php
    class Database {
        private $connection;
        private $database;
        private $insertMark;
        private $selectMark;
        private $selectMarks;
        private $selectStudent;
        private $selectUser;
        private $insertToken;
        private $selectToken;
        private $selectUserById;
        private $insertUser;
        private $insertQuestion;
        private $selectStudentsWithMarks;
        private $selectQuestionsByCategory;

        private $tableStudents;
        private $tableTokens;
        private $tableQuestions;
        private $tableTests;

        public function __construct() {
            $config = parse_ini_file('../config/config.ini', true);

            $type = $config['db']['db_type'];
            $host = $config['db']['host'];
            $name = $config['db']['db_name'];
            $user = $config['db']['user'];
            $password = $config['db']['password'];

            $this->init($type, $host, $name, $user, $password);
        }

        private function init($type, $host, $name, $user, $password) {
            try {
                $this->connection = new PDO("$type:host=$host;dbname=$name", $user, $password,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

                $this->prepareStatements();
                $this->createTableStudents();
                $this->createTableTokens();
                //$this->createTableTests();
                $this->createTableQuestions();
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

        private function prepareStatements() {
            $sql = "CREATE TABLE IF NOT EXISTS users(
                id int(11) NOT NULL AUTO_INCREMENT,
                username varchar(50) NOT NULL,
                email varchar(50) NOT NULL,
                pass varchar(100) NOT NULL,
                PRIMARY KEY (id)
               )";
            $this->tableStudents = $this->connection->prepare($sql);
            
            $sql = "CREATE TABLE IF NOT EXISTS tokens(
                token varchar(10),
                user_id int(11) NOT NULL,
                expires varchar(50) NOT NULL,
                PRIMARY KEY (user_id)
               )";
            $this->tableTokens = $this->connection->prepare($sql);

            // $sql = "CREATE TABLE IF NOT EXISTS tests(
            //     id int(11) NOT NULL AUTO_INCREMENT,
            //     testname varchar(30),
            //     PRIMARY KEY (id)
            //    )";
            // $this->tableTests = $this->connection->prepare($sql);

            $sql = "CREATE TABLE IF NOT EXISTS questions(
                questiontext varchar(100) NOT NULL,
                answer1 varchar(50),
                answer2 varchar(50),
                answer3 varchar(50),
                answer4 varchar(50),
                answer5 varchar(50),
                answer6 varchar(50),
                correctAnswer int(11),
                category varchar(50),
                PRIMARY KEY (questiontext)
               )";
            $this->tableQuestions = $this->connection->prepare($sql);
            
            // $sql = "INSERT INTO marks(studentFN, mark) VALUES(:fn, :mark)";
            // $this->insertMark = $this->connection->prepare($sql);

            // $sql = "SELECT * FROM marks WHERE studentFn = :fn";
            // $this->selectMark = $this->connection->prepare($sql);

            // $sql = "SELECT * FROM marks";
            // $this->selectMarks = $this->connection->prepare($sql);

            // $sql = "SELECT * FROM students WHERE fn = :fn";
            // $this->selectStudent = $this->connection->prepare($sql);

            $sql = "SELECT * FROM users WHERE username = :username";
            $this->selectUser = $this->connection->prepare($sql);

            $sql = "SELECT * FROM users WHERE id=:id";
            $this->selectUserById = $this->connection->prepare($sql);

            $sql = "INSERT INTO tokens(token, user_id, expires) VALUES (:token, :user_id, :expires)";
            $this->insertToken = $this->connection->prepare($sql);

            $sql = "SELECT * FROM tokens WHERE token=:token";
            $this->selectToken = $this->connection->prepare($sql);
            
            $sql = "INSERT INTO users(username, email, pass) VALUES (:username, :email, :pass)";
            $this->insertUser = $this->connection->prepare($sql);

            $sql = "INSERT INTO questions(questiontext, answer1, answer2, answer3, answer4, answer5, answer6, correctAnswer, category) VALUES (:questiontext, :answer1, :answer2, :answer3, :answer4, :answer5, :answer6, :correctAnswer, :category)";
            $this->insertQuestion = $this->connection->prepare($sql);

            $sql = "SELECT * FROM questions WHERE category = :category";
            $this->selectQuestionsByCategory = $this->connection->prepare($sql);
        
            // $sql = "SELECT firstName, lastName, fn, mark FROM students JOIN marks ON fn = studentFN";
            // $this->selectStudentsWithMarks = $this->connection->prepare($sql);
        }

        // public function createTableTests() {
        //     try {
        //         $this->tableTests->execute();
        //         return ["success" => true];
        //     } catch(PDOException $e) {
        //         return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
        //     }
        // }

        public function createTableQuestions() {
            try {
                $this->tableQuestions->execute();
                return ["success" => true];
            } catch(PDOException $e) {
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function createTableStudents() {
            try {
                $this->tableStudents->execute();
                return ["success" => true];
            } catch(PDOException $e) {
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function createTableTokens() {
            try {
                $this->tableTokens->execute();
                return ["success" => true];
            } catch(PDOException $e) {
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function selectStudentsWithMarksQuery() {
            try {
                $this->selectStudentsWithMarksQuery->execute();

                return ["success" => true];
            } catch(PDOException $e) {
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        // $data -> ["fn" => value, "mark" => value]
        public function insertMarkQuery($data) {
            try {
                $this->insertMark->execute($data);

                return ["success" => true];
            } catch(PDOException $e) {
                $this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function selectMarkQuery($data) {
            try {
                $this->selectMark->execute($data);

                return ["success" => true, "data" => $this->selectMark];
            } catch(PDOException $e) {
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function selectMarksQuery() {
            try {
                $this->selectMarks->execute();

                return ["success" => true, "data" => $this->selectMarks];
            } catch(PDOException $e) {
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function selectStudentQuery($data) {
            try {
                $this->selectStudent->execute($data);

                return ["success" => true, "data" => $this->selectStudent];
            } catch(PDOException $e) {
                $this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function selectQuestionsByCategoryQuery($data) {
            try {
                $this->selectQuestionsByCategory->execute($data);

                return ["success" => true, "data" => $this->selectQuestionsByCategory];
            } catch(PDOException $e) {
                $this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function selectUserQuery($data) {
            try {
                // ["user" => "..."]
                $this->selectUser->execute($data);

                return ["success" => true, "data" => $this->selectUser];
            } catch(PDOException $e) {
                return ["success" => false, "error" => $e->getMessage()];
            }
        }

         /**
         * We use this method to execute queries for getting user data by user id
         * We only execute the created prepared statement for selecting user in DB with new database
         * If the query was executed successfully, we return the result of the executed query
         */
        public function selectUserByIdQuery($data) {
            try{
                $this->selectUserById->execute($data);

                return array("success" => true, "data" => $this->selectUserById);
            } catch(PDOException $e){
                echo "Connection failed: " . $e->getMessage();

                return array("success" => false, "error" => $e->getMessage());
            }
        }

        /**
         * We use this method to execute queries for inserting user session token
         * We only execute the created prepared statement for inserting user in DB with new database
         */
        public function insertTokenQuery($data) {
            try{
                $this->insertToken->execute($data);

                return array("success" => true);
            } catch(PDOException $e){
                // $this->connection->rollBack();
                echo "Connection failed: " . $e->getMessage();
                return array("success" => false, "error" => $e->getMessage());
            }
        }

        /**
         * We use this method to execute queries for getting user session token
         * We only execute the created prepared statement for selecting user in DB with new database
         * If the query was executed successfully, we return the result of the executed query
         */
        public function selectTokenQuery($data) {
            try{
                $this->selectToken->execute($data);

                return array("success" => true, "data" => $this->selectToken);
            } catch(PDOException $e){
                echo "Connection failed: " . $e->getMessage();

                return array("success" => false, "error" => $e->getMessage());
            }
        }

        public function insertUserQuery($data) {
            try {
                $this->insertUser->execute($data);

                return ["success" => true];
            } catch(PDOException $e) {
                //$this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function insertQuestionQuery($data) {
            try {
                $this->insertQuestion->execute($data);

                return ["success" => true];
            } catch(PDOException $e) {
                //$this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        /**
         * Close the connection to the DB
         */
        function __destruct() {
            $this->connection = null;
        }
    }
?>
