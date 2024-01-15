<?php
include('../connection.php'); 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

$teacherId = $_GET['teacher_id'];
$query = "SELECT subjects.*, subject_teachers.section_id, sections.section_name FROM subjects JOIN subject_teachers ON subjects.subject_id = subject_teachers.subject_id
JOIN sections ON sections.section_id = subject_teachers.section_id WHERE subject_teachers.teacher_id = '$teacherId'";

$result = $connectNow->query($query);

if($result->num_rows > 0) {
    $teacherRecord = array();
    while($rowFound = $result->fetch_assoc()) {
        $teacherRecord[] = $rowFound;
    }
    echo json_encode($teacherRecord);
}
$connectNow->close();
?>
