<?php
include('../connection.php'); 

if(isset($_POST['teacher_id'], $_POST['subject_name'], $_POST['subject_code'], $_POST['section_name'], $_POST['semester'])) {
// for dynamic values from frontend
$teacherId =  $_POST['teacher_id'];
$subjectName = $_POST['subject_name'];
$subjectCode = $_POST['subject_code'];
$sectionName = $_POST['section_name'];
$semester = $_POST['semester'];

// for testing backend
// $teacherId = '7';
// $subjectName = 'Networking';
// $subjectCode = 'IT314';
// $sectionName = 'R7';
// $semester = '1st Semester';

// Check if subject exists
$query = "SELECT subject_id FROM subjects WHERE subject_name = '$subjectName' AND subject_code = '$subjectCode';";
$result = $connectNow->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $subject_id = $row['subject_id'];
} else {
    // If subject doesn't exist, create a new one
    $query = "INSERT INTO subjects (subject_name, subject_code) VALUES ('$subjectName', '$subjectCode');";
    $connectNow->query($query);
    $subject_id = $connectNow->insert_id;
}

// Check if section exists
$query = "SELECT section_id FROM sections WHERE section_name = '$sectionName' AND semester = '$semester';";
$result = $connectNow->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $section_id = $row['section_id'];
} else {
    // If section doesn't exist, create a new one
    $query = "INSERT INTO sections (semester, section_name) VALUES ('$semester', '$sectionName');";
    $connectNow->query($query);
    $section_id = $connectNow->insert_id;
}

// Insert into subject_teachers table
$query = "INSERT INTO subject_teachers (subject_id, teacher_id, section_id) VALUES ('$subject_id', '$teacherId', '$section_id');";
$result = $connectNow->query($query);

if ($result) {
    $response = "Data inserted successfully";
} else {
    $response = "Error inserting data: " . $connectNow->error;
}

} else {
    $response = "Invalid data received";
}

echo json_encode($response);

$connectNow->close();
?>
