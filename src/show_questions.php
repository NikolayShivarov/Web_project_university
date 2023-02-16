<?php
require_once './auth_session.php';
require_once "./db.php";
$db = new Database();
$result = array();
if(isset($_GET['action']) && $_GET['action'] == 'delete'){   
    deleteQuestion($_GET['questionId'],$db);
}

function deleteQuestion($questionId,$db){
     $query = $db->deleteQuestionByIdQuery(['id'=>$questionId]);
     $query = $db->deleteReviewByQuestionIdQuery(['questionId'=>$questionId]);
     $query = $db->deleteRatingByQuestionIdQuery(['questionId'=>$questionId]);
}

function deleteAllQuestions($questions, $db){
    for ($i = 0; $i < sizeof($questions); $i++) {
        deleteQuestion($questions[$i]['id'],$db);
    }
}


function checkQuestion($question,$category,$difficulty,$fn) {
    if($category != 'All' && $category != 0 && $category != $question['category']){
        return false;
    }
    if($difficulty != 'All' && $difficulty != 0 && $difficulty != $question['difficulty']){
        return false;
    }
    if($fn != 'All' && $fn != 0 && $fn != $question['fn']){
        return false;
    }
    return true;
}

if($_POST) {
    $query = $db->selectAllQuestionsQuery();
    $resarr = $query["data"]->fetchAll(PDO::FETCH_ASSOC);
    $g = 0;
    for($i = 0;$i < sizeof($resarr);$i++){
        if(checkQuestion($resarr[$i],$_POST['select_category'],$_POST['select_difficulty'],$_POST['select_fn'])){
            $result[$g] = $resarr[$i];
            $g++;
        }         
    } 

    if(isset($_POST['delete_all'])){
        deleteAllQuestions($result,$db);
    }
}



?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta chareset="utf-8"/>
    <script defer src="../scripts/sendRequestUtility.js"></script>
    <script defer src="../scripts/manageQuestions.js"></script>
    <script defer src="../scripts/navbar2.js"></script>
    <link rel="stylesheet" href="../styles/index.css"/>
    <title>Managing questions</title>
</head>
<body>
<header>
        <ul id = "nav">
          <li><button class="smallspecialbutton" id="../logout">Logout</button></li>
          <li><a href="../index.php">Home</a></li>
          <li><a href="../test_menu.php">Test menu</a></li>
          <li><a href="./view_user_reviews.php">Your reviews</a></li>
        </ul> 
</header>   
<div>
    <form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
    <select name =  "select_category" id="test_selection">
        <option value="0" selected>Select category</option>
        <option value="All">All</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>

    <select name = "select_difficulty" id = "test_difficulty">
    <option value="0" selected>Select difficulty</option>
    <option value="All">All</option>
    <option value="1" >1</option>
    <option value="2" >2</option>
    <option value="3" >3</option>
    <option value="4" >4</option>
    <option value="5" >5</option>
    </select>
    
    <select name =  "select_fn" id="test_fn">
        <option value="0" selected>Select fn</option>
        <option value="All">All</option>
    </select>

    <button class="smallspecialbutton" type ="submit" value = "Click">Show Results</button> 
    <button class="smallspecialbuttonred" name ="delete_all" value = "Del">Delete All Results</button> 
    </form>
    
    <h1>Manage Questions</h1>
    <table cellspacing="2" cellpadding="2" borders="1">
        <tr>
            <th>Question Text</th>
            <th>Answer1</th>
            <th>Answer2</th>
            <th>Answer3</th>
            <th>Answer4</th>
            <th>Difficulty</th>
            <th>fn</th>
            <th>Correct</th>
            <th>Category</th>
       </tr>
       <?php foreach($result as $question){ ?>
        <tr>
            <td><?php echo $question['questiontext'] ?></td>
            <td><?php echo $question['answer1'] ?></td>
            <td><?php echo $question['answer2'] ?></td>
            <td><?php echo $question['answer3'] ?></td>
            <td><?php echo $question['answer4'] ?></td>
            <td><?php echo $question['difficulty'] ?></td>
            <td><?php echo $question['fn'] ?></td>
            <td><?php echo $question['correctAnswer'] ?></td>
            <td><?php echo $question['category'] ?></td>
            <td>
                <a onclick="return confirm('Do you want to delete this question?');" class="delete-button" href="show_questions.php?questionId=<?php
                 echo $question['id'] ?>&action=delete"><button class="delete-btn">DELETE</button></a>
            </td> 
            
            <td>              
            <a onclick="return confirm('Do you want to view this question?');" class="view-button" href="question_info.php?questionId=<?php
                 echo $question['id'] ?>&action=view"><button class="view-btn">VIEW</button></a>
            </td>
            
       </tr>

        <?php } ?>

    </table>   
  
</div>
</body>
</html>