<?php
include('../connection.php'); 

// orig
if(isset($_POST['teacher_id'], $_POST['subject_name'], $_POST['section_name'], $_POST['start_time'], $_POST['end_time'], $_POST['days_of_week'])){
    $teacherId  = $_POST['teacher_id'];
    $subjectName = $_POST['subject_name'];
    $sectionName = $_POST['section_name'];
    $startTime = $_POST['start_time'];
    $endTime = $_POST['end_time'];
    $daysOfWeek = $_POST['days_of_week'];
}else{
    $response = "wala na received from frontend";
}

// Extract time from the TimeOfDay() wrapper
$startTime = substr($startTime, 10, 5);
$endTime = substr($endTime, 10, 5);
// testing
// $teacherId  = '8';
// $subjectName = 'Mobile Programming';
// $sectionName = 'R7';
// $startTime = '08:00:00';
// $endTime = '12:00:00';
// $daysOfWeek = 'Monday';

$query = "SELECT subjects.subject_id FROM subjects WHERE subject_name = '$subjectName'";

// $query = "SELECT student_id FROM students WHERE email = '$email'";
$result = $connectNow->query($query);

//use existing subject_id
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $subjectId = $row['subject_id'];
} else {
    echo 'error kuha subject_id';
}

$query = "SELECT sections.section_id
          FROM sections
          WHERE section_name = '$sectionName'";
$result = $connectNow->query($query);

//use existing section_id
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $sectionId = $row['section_id'];
} else {
    echo 'error kuha section_id';
}

$query = "INSERT INTO class_schedules (teacher_id, subject_id, section_id, start_time, end_time, day_of_week)
VALUES ('$teacherId','$subjectId', '$sectionId', '$startTime', '$endTime', '$daysOfWeek')";
    
$result = $connectNow->query($query);

if ($result) {
    echo json_encode(array("success"=>true));
} else {
    echo json_encode(array("success"=>false));
}
$connectNow->close();
?>