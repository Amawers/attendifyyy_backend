<?php
include('../connection.php'); 
$studentId = $_GET['student_id'];

$query = "DELETE FROM students WHERE student_id = '$studentId'";
$result = $connectNow->query($query);

if ($result) {
    echo json_encode(array("success"=>true));
} else {
    echo json_encode(array("success"=>false));
}
$connectNow->close();
?>
