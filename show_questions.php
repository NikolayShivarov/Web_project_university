<?php
require_once './src/auth_session.php';
require_once "./src/db.php";
$db = new Database();
$result = array();
if(isset($_GET['action']) && $_GET['action'] == 'delete'){   
    $query2 = $db->deleteQuestionByNameQuery(['questiontext' => $_GET['questiontext'] ]);
}

if(isset($_POST['select_category'])) {
    if($_POST['select_category'] != "All"){
    $query = $db->selectQuestionsByCategoryQuery(["category" => $_POST['select_category']]);
    $result = $query["data"]->fetchAll(PDO::FETCH_ASSOC);
}else{
    $query = $db->selectAllQuestionsQuery();
    $result = $query['data']->fetchAll(PDO::FETCH_ASSOC);
}

}
     

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta chareset="utf-8"/>
    <script defer src="./scripts/sendRequestUtility.js"></script>
    <script defer src="./scripts/manageQuestions.js"></script>
    <link rel="stylesheet" href="./styles/index.css"/>
    <title>Managing questions</title>
</head>
<body>
<header>
        <ul>
          <li><button id="./logout">Logout</button></li>
          <li><a href="./index.php">Home</a></li>
          <li><a  href="./addtest.php">Import Questions</a></li>
          <li><a href="#contact">Export Questions</a></li>
          <li><a class="active" href="./show_questions.php">Manage questions</a></li>
          <li><a href="./test_menu.php">Test menu</a></li>
        </ul> 
</header>   
<div>
    <form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
    <select name =  "select_category" id="test_selection" onchange="this.form.submit();">
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
        <option value="1" selected>Select fn</option>
        <option value="All">All</option>
    </select>

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
                <a onclick="return confirm('Do you want to delete this question?');" class="delete-button" href="show_questions.php?questiontext=<?php
                 echo $question['questiontext'] ?>&action=delete"><button class="delete-btn">DELETE</button></a>
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