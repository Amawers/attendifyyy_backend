<?php
include('../connection.php'); 
$input_data = file_get_contents('php://input');

parse_str($input_data, $decoded_data);

if(isset($decoded_data['subject_teachers_id'], $decoded_data['subject_name'], $decoded_data['subject_code'], $decoded_data['section_name'], $decoded_data['semester'])){
    $subjectTeachersId = $decoded_data['subject_teachers_id'];
    $subjectName = $decoded_data['subject_name'];
    $subjectCode = $decoded_data['subject_code'];
    $sectionName = $decoded_data['section_name'];
    $semester = $decoded_data['semester'];
}else{
    $response = "wala na received diri sa backend ang mga values";
}

$query = "UPDATE subject_teachers
JOIN subjects ON subject_teachers.subject_id = subjects.subject_id
JOIN teachers ON subject_teachers.teacher_id = teachers.teacher_id
JOIN sections ON subject_teachers.section_id = sections.section_id
SET subjects.subject_name = '$subjectName',
    subjects.subject_code = '$subjectCode',
    sections.section_name = '$sectionName',
    sections.semester = '$semester'
WHERE subject_teachers.subject_teachers_id = '$subjectTeachersId'";

$result = $connectNow->query($query);


if ($result) {
    echo json_encode(array("success"=>true));
} else {
    echo json_encode(array("success"=>false));
}

$connectNow->close();
?>
