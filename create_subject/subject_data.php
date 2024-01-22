<?php
include('../connection.php'); 

$subjectId = $_GET['subject_id'];

// //testing purpose
// $teacherId  = '8';

$query = "SELECT * FROM subjects WHERE subjects.subject_id = '$subjectId'";

$result = $connectNow->query($query);

if($result->num_rows > 0) {
    $subjectDataList = array();
    while($rowFound = $result->fetch_assoc()) {
        $subjectDataList[] = $rowFound;
    }
    echo json_encode($subjectDataList);
}
$connectNow->close();
?>