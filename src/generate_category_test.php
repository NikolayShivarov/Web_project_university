
<?php
require_once 'db.php';


function selectByCategory($category) {
    $db= new Database();
    $query = $db->selectQuestionsByCategoryQuery(["category" => $category]);
    
    if ($query["success"]) {
        $data = array();
        $data = $query["data"]->fetchAll(PDO::FETCH_ASSOC); 
        return $data;            
    } else {
        return false;
    }
}
$category;
if ($_POST) {
    $category = $_POST['category'];
}
//print_r($data);
// $category = "крипто";
// $category = '<script>
//      var a =  localStorage.getItem("textvalue");
//      document.write(a);
//  </script>';
// $connect = new PDO('mysql:host=localhost;dbname=webproject','root','');
// $stmt = $connect->prepare('select * from questions where category = :category');
// $stmt->bindValue('category',$category);
// $stmt->execute();
// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$result = selectByCategory($category);

// print_r($category);


// $conn = mysqli_connect("localhost", "root", "", "webproject");
// $data = array();
// $result =  selectByCategory($category);
// print_r($result);
// while ($row = mysqli_fetch_object($result))
// {
//     array_push($data, $row);
// }

//print_r($data);
// print_r($result);
echo json_encode($result);
exit(); ?>

