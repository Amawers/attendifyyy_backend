<?php
include('../connection.php'); 
$headers = getallheaders();

$subjectName = $headers['subject_name'];
$sectionId = $headers['section_id'];
$subjectId = $headers['subject_id'];
$teacherId = $headers['teacher_id'];

//testing purpose
// $subjectName = 'Mobile Programming';
// $sectionId = '9';
// $subjectId = '9';
// $teacherId = $_GET['teacher_id'];

$query = "SELECT DISTINCT students.student_id, students.first_name, students.last_name, students.grade_level
FROM students
JOIN student_subjects ON students.student_id = student_subjects.student_id
JOIN subjects ON student_subjects.subject_id = subjects.subject_id
JOIN subject_teachers ON subjects.subject_id = subject_teachers.subject_id
LEFT JOIN sections ON subject_teachers.section_id = sections.section_id
WHERE
  subject_teachers.teacher_id = '$teacherId'
  AND subjects.subject_name = '$subjectName'
  AND (
    student_subjects.section_id = '$sectionId' OR
    (student_subjects.section_id IS NULL AND '$sectionId' IS NULL)
  )
  AND student_subjects.subject_id = $subjectId";

$result = $connectNow->query($query);

if($result->num_rows > 0) {
    $studentList = array();
    while($rowFound = $result->fetch_assoc()) {
        $studentList[] = $rowFound;
    }
    echo json_encode($studentList);
}else{
    echo "didn't receive";
}
$connectNow->close();

?>