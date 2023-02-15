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
        private $insertReview;
        private $selectStudentsWithMarks;
        private $selectAllQuestions;
        private $selectQuestionsByCategory;
        private $selectQuestionTextById;
        private $selectQuestionById;
        private $deleteQuestionByName;
        private $selectCategories;
        private $deleteQuestionById;
        private $deleteReviewByQuestionId;
        private $deleteReviewByUserId;
        private $deleteSpecificReview;
        private $selectReviewsByQuestionId;
        private $selectReviewsByUserId;
        private $selectAllFn;
        private $selectStatisticById;
        private $insertStatistic;
        private $addCorrectById; 
        private $addWrongById;
        private $insertRating;
        private $selectRatingByUserId;
        private $selectRatingByQuestionId;
        private $deleteRatingByQuestionId;


        private $tableStudents;
        private $tableTokens;
        private $tableQuestions;
        private $tableTests;
        private $tableReviews;
        private $tableStatistic;
        private $tableRatings;

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
                $this->createTableReviews();
                $this->createTableQuestions();
                $this->createTableStatistic();
                $this->createTableRatings();
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
                isadmin boolean DEFAULT 0,
                PRIMARY KEY (id),
                CONSTRAINT unique_username UNIQUE (username)
               )";
            $this->tableStudents = $this->connection->prepare($sql);
            
            $sql = "CREATE TABLE IF NOT EXISTS tokens(
                token varchar(10),
                user_id int(11) NOT NULL,
                expires varchar(50) NOT NULL,
                PRIMARY KEY (user_id)
               )";
            $this->tableTokens = $this->connection->prepare($sql);

            $sql = "CREATE TABLE IF NOT EXISTS questions(
                id int(11) NOT NULL AUTO_INCREMENT,
                questiontext varchar(300) NOT NULL,
                answer1 varchar(300),
                answer2 varchar(300),
                answer3 varchar(300),
                answer4 varchar(300),
                correctAnswer TINYINT,
                fn int(11),
                correctfeedback varchar(300),
                wrongfeedback varchar(300),
                category TINYINT,
                difficulty TINYINT,
                PRIMARY KEY (id),
                CONSTRAINT unique_question UNIQUE (questiontext, answer1, answer2, answer3, answer4)
               )";
            $this->tableQuestions = $this->connection->prepare($sql);

            $sql = "CREATE TABLE IF NOT EXISTS reviews(
                questionId int(11) NOT NULL,
                userId int(11) NOT NULL,
                reviewText varchar(300),
                PRIMARY KEY (questionId, userId)
            )";

            $this->tableReviews = $this->connection->prepare($sql);

            $sql = "CREATE TABLE IF NOT EXISTS statistic(
                id int(11) NOT NULL,
                correct int(11) NOT NULL,
                wrong int(11) NOT NULL,
                PRIMARY KEY (questionId)
            )";

            $this->tableStatistic = $this->connection->prepare($sql);

            $sql = "CREATE TABLE IF NOT EXISTS ratings(
                userId int(11) NOT NULL,
                questionId int(11) NOT NULL,
                rating tinyint NOT NULL,
                PRIMARY KEY (userId,questionId),
                CONSTRAINT rating_size CHECK (rating BETWEEN 0 AND 10)
            )";

            $this->tableRatings = $this->connection->prepare($sql);
            

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

            $sql = "INSERT INTO questions(questiontext, answer1, answer2, answer3, answer4, correctAnswer, fn, correctfeedback, wrongfeedback, category, difficulty) VALUES (:questiontext, :answer1, :answer2, :answer3, :answer4, :correctAnswer, :fn, :correctfeedback, :wrongfeedback, :category, :difficulty)";
            $this->insertQuestion = $this->connection->prepare($sql);

            $sql = "INSERT INTO reviews(questionId, userId, reviewText) VALUES (:questionId, :userId, :reviewText)";
            $this->insertReview = $this->connection->prepare($sql);
            
            $sql = "SELECT * FROM questions";
            $this->selectAllQuestions = $this->connection->prepare($sql);

            $sql = "SELECT * FROM questions WHERE category = :category";
            $this->selectQuestionsByCategory = $this->connection->prepare($sql);
            
            $sql = "DELETE from questions where questiontext = :questiontext";
            $this->deleteQuestionByName = $this->connection->prepare($sql);

            $sql = "SELECT distinct category FROM questions";
            $this->selectCategories = $this->connection->prepare($sql);

            $sql = "DELETE from questions where id = :id";
            $this->deleteQuestionById = $this->connection->prepare($sql);
            
            $sql = "DELETE from reviews where questionId = :questionId";
            $this->deleteReviewByQuestionId = $this->connection->prepare($sql);

            $sql = "DELETE from reviews where userId = :userId";
            $this->deleteReviewByUserId = $this->connection->prepare($sql);

            $sql = "DELETE from reviews where userId = :userId AND questionId = :questionId";
            $this->deleteSpecificReview = $this->connection->prepare($sql);


            $sql = "SELECT * FROM reviews WHERE questionId = :questionId";
            $this->selectReviewsByQuestionId = $this->connection->prepare($sql);

            $sql = "SELECT * FROM reviews WHERE userId = :userId";
            $this->selectReviewsByUserId = $this->connection->prepare($sql);

            $sql = "SELECT questiontext FROM questions WHERE id = :id";
            $this->selectQuestionTextById = $this->connection->prepare($sql);

            $sql = "SELECT * FROM questions WHERE id = :id";
            $this->selectQuestionById = $this->connection->prepare($sql);

            $sql = "SELECT distinct fn FROM questions";
            $this->selectAllFn = $this->connection->prepare($sql);

            $sql = "SELECT * FROM statistic WHERE id = :id";
            $this->selectStatisticById = $this->connection->prepare($sql);

            $sql = "INSERT INTO statistic(id, correct, wrong) VALUES (:id, 0, 0)";
            $this->insertStatistic = $this->connection->prepare($sql);

            $sql = "UPDATE statistic SET correct = correct + 1 WHERE id = :id";
            $this->addCorrectById = $this->connection->prepare($sql);

            $sql = "UPDATE statistic SET wrong = wrong + 1 WHERE id = :id";
            $this->addWrongById = $this->connection->prepare($sql);

            $sql = "INSERT INTO ratings(userId, questionId, rating) VALUES (:userId, :questionId, :rating)";
            $this->insertRating = $this->connection->prepare($sql);

            $sql = "SELECT * FROM ratings WHERE userId = :userId";
            $this->selectRatingByUserId = $this->connection->prepare($sql);

            $sql = "SELECT * FROM ratings WHERE questionId = :questionId";
            $this->selectRatingByQuestionId = $this->connection->prepare($sql);
            
            $sql = "DELETE FROM ratings WHERE questionId = :questionId";
            $this->deleteRatingByQuestionId = $this->connection->prepare($sql);
        
            // $sql = "SELECT firstName, lastName, fn, mark FROM students JOIN marks ON fn = studentFN";
            // $this->selectStudentsWithMarks = $this->connection->prepare($sql);
        }

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

        public function createTableReviews() {
            try {
                $this->tableReviews->execute();
                return ["success" => true];
            } catch(PDOException $e) {
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function createTableStatistic() {
            try {
                $this->tableStatistic->execute();
                return ["success" => true];
            } catch(PDOException $e) {
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function createTableRatings() {
            try {
                $this->tableRatings->execute();
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
        public function selectAllQuestionsQuery() {
            try {
                $this->selectAllQuestions->execute();

                return ["success" => true, "data" => $this->selectAllQuestions];
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

        public function selectQuestionTextByIdQuery($data) {
            try {
                $this->selectQuestionTextById->execute($data);

                return ["success" => true, "data" => $this->selectQuestionTextById];
            } catch(PDOException $e) {
                $this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function selectQuestionByIdQuery($data) {
            try {
                $this->selectQuestionById->execute($data);

                return ["success" => true, "data" => $this->selectQuestionById];
            } catch(PDOException $e) {
                $this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function selectReviewsByQuestionIdQuery($data) {
            try {
                $this->selectReviewsByQuestionId->execute($data);

                return ["success" => true, "data" => $this->selectReviewsByQuestionId];
            } catch(PDOException $e) {
                $this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function selectReviewsByUserIdQuery($data) {
            try {
                $this->selectReviewsByUserId->execute($data);

                return ["success" => true, "data" => $this->selectReviewsByUserId];
            } catch(PDOException $e) {
                $this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function deleteQuestionByNameQuery($data) {
            try {
                $this->deleteQuestionByName->execute($data);
                return array("success" => true);
            } catch(PDOException $e) {
                $this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function deleteQuestionByIdQuery($data) {
            try {
                $this->deleteQuestionById->execute($data);
                return array("success" => true);
            } catch(PDOException $e) {
                $this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }


        public function deleteReviewByQuestionIdQuery($data) {
            try {
                $this->deleteReviewByQuestionId->execute($data);
                return array("success" => true);
            } catch(PDOException $e) {
                $this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function deleteReviewByUserIdQuery($data) {
            try {
                $this->deleteReviewByUserId->execute($data);
                return array("success" => true);
            } catch(PDOException $e) {
                $this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function deleteSpecificReviewQuery($data) {
            try {
                $this->deleteSpecificReview->execute($data);
                return array("success" => true);
            } catch(PDOException $e) {
                $this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }



        public function selectCategoriesQuery() {
            try {
                $this->selectCategories->execute();

                return ["success" => true, "data" => $this->selectCategories];
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

        public function insertReviewQuery($data) {
            try {
                $this->insertReview->execute($data);

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

        public function selectAllFnQuery() {
            try {
                $this->selectAllFn->execute();

                return ["success" => true, "data" => $this->selectAllFn];
            } catch(PDOException $e) {
                $this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        

        public function selectStatisticByIdQuery($data) {
            try {
                $this->selectStatisticById->execute($data);

                return ["success" => true, "data" => $this->selectStatisticById];
            } catch(PDOException $e) {
                $this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function addCorrectByIdQuery($data) {
            try {
                $this->addCorrectById->execute($data);

                return ["success" => true];
            } catch(PDOException $e) {
                //$this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function addWrongByIdQuery($data) {
            try {
                $this->addWrongById->execute($data);

                return ["success" => true];
            } catch(PDOException $e) {
                //$this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function insertStatisticQuery($data) {
            try {
                $this->insertStatistic->execute($data);

                return ["success" => true];
            } catch(PDOException $e) {
                //$this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function insertRatingQuery($data) {
            try {
                $this->insertRating->execute($data);

                return ["success" => true];
            } catch(PDOException $e) {
                //$this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function selectRatingByUserIdQuery($data) {
            try {
                $this->selectRatingByUserId->execute($data);

                return ["success" => true, "data" => $this->selectRatingByUserId];
            } catch(PDOException $e) {
                $this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function selectRatingByQuestionIdQuery($data) {
            try {
                $this->selectRatingByQuestionId->execute($data);

                return ["success" => true, "data" => $this->selectRatingByQuestionId];
            } catch(PDOException $e) {
                $this->connection->rollBack();
                return ["success" => false, "error" => "Connection failed: " . $e->getMessage()];
            }
        }

        public function deleteRatingByQuestionIdQuery($data) {
            try {
                $this->deleteRatingByQuestionId->execute($data);
                return array("success" => true);
            } catch(PDOException $e) {
                $this->connection->rollBack();
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
