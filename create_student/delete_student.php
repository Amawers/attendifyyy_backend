<?php
include('../connection.php'); 
$studentId = $_GET['student_id'];

$query = "DELETE FROM students WHERE student_id = '$studentId'";
$result = $connectNow->query($query);

echo json_encode($result);
$connectNow->close();
?>
