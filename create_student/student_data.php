<?php
include('../connection.php'); 

$studentId = $_GET['student_id'];

// //testing purpose
// $teacherId  = '8';

$query = "SELECT * FROM students WHERE students.student_id = '$studentId'";

$result = $connectNow->query($query);

if($result->num_rows > 0) {
    $studentDataList = array();
    while($rowFound = $result->fetch_assoc()) {
        $studentDataList[] = $rowFound;
    }
    echo json_encode(array("success"=>true,"student_subject_data"=>$studentDataList));
}else{
    $error = array();
    $error = ["error"=>"error lods"];
    echo json_encode(array("success"=>false,"student_subject_data"=>$error));
}
$connectNow->close();
?>