<?php 
$conn = mysqli_connect("localhost", "root", "", "webproject") ;
$result = mysqli_query($conn, "SELECT distinct category FROM questions");
$data = array();
while ($row = mysqli_fetch_object($result))
{
    array_push($data, $row);
}

echo json_encode($data);
exit();

?>





