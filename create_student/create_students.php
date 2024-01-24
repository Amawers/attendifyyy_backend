<?php
include('../connection.php'); 


if(isset($_POST['reference_number'], $_POST['first_name'], $_POST['middle_initial'], $_POST['last_name'], $_POST['email'], $_POST['course'], $_POST['grade_level'], $_POST['subject_id'], $_POST['section_id'])){
    $referenceNumber = $_POST['reference_number'];
    $firstName = $_POST['first_name'];
    $middleInitial = $_POST['middle_initial'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $gradeLevel = $_POST['grade_level'];
    $subjectId = $_POST['subject_id'];
    $sectionId = $_POST['section_id'];
}else{
    $response = "wala na received from frontend";
}

$query = "SELECT student_id FROM students WHERE email = '$email'";
$result = $connectNow->query($query);

//use existing student_id
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $studentId = $row['student_id'];
} else {
    // If student_id doesn't exist, create a new one
    $query = "INSERT INTO students (reference_number, first_name, middle_initial, last_name, email, course, grade_level)
    VALUES ('$referenceNumber', '$firstName', '$middleInitial', '$lastName', '$email', '$course', '$gradeLevel')";
    $connectNow->query($query);
    $studentId = $connectNow->insert_id;
}

$query = "INSERT INTO student_subjects (student_id, subject_id, section_id)
    VALUES ('$studentId', '$subjectId', '$sectionId');";
    
$result = $connectNow->query($query);

if ($result) {
    echo json_encode(array("success"=>true));
} else {
    echo json_encode(array("success"=>false));
}

$connectNow->close();
?>