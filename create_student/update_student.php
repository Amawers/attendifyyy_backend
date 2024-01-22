<?php
include('../connection.php'); 
$input_data = file_get_contents('php://input');

parse_str($input_data, $decoded_data);

if(isset($decoded_data['student_id'], $decoded_data['reference_number'], $decoded_data['first_name'], $decoded_data['middle_initial'], $decoded_data['last_name'], $decoded_data['email'], $decoded_data['course'], $decoded_data['grade_level'])){
    $studentId = $decoded_data['student_id'];
    $referenceNumber = $decoded_data['reference_number'];
    $firstName = $decoded_data['first_name'];
    $middleInitial = $decoded_data['middle_initial'];
    $lastName = $decoded_data['last_name'];
    $email = $decoded_data['email'];
    $course = $decoded_data['course'];
    $gradeLevel = $decoded_data['grade_level'];
}else{
    $response = "wala na received diri sa backend ang mga values";
}

$query = "UPDATE students 
SET reference_number = '$referenceNumber',
first_name = '$firstName', 
middle_initial = '$middleInitial', 
last_name = '$lastName',
email = '$email',
course = '$course',
grade_level = '$gradeLevel' 
WHERE student_id = '$studentId'";

$result = $connectNow->query($query);


if ($result) {
    $response = "Data inserted successfully";
} else {
    $response = "Error inserting data: " . $connectNow->error;
}
echo json_encode($response);

$connectNow->close();
?>
