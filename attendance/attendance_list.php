<?php
include('../connection.php');

// orig
$teacherId = $_POST['teacher_id'];
$subjectName = $_POST['subject_name'];
$sectionName = $_POST['section_name'];


// testing purpose
// $teacherId = '8';
// $subjectName = 'Mobile Programming';
// $sectionName = 'R7';


$query = "SELECT cs.schedule_id 
FROM class_schedules cs
JOIN subjects ON cs.subject_id = subjects.subject_id
JOIN sections ON cs.section_id = sections.section_id
WHERE cs.teacher_id = '$teacherId' 
AND subjects.subject_name = '$subjectName'
AND sections.section_name = '$sectionName'";


$result = $connectNow->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $scheduleId = $row['schedule_id'];
}

$query = "SELECT sub.subject_name, s.first_name, s.last_name, a.attendance_status, CURRENT_DATE() AS attendance_date, 
TIME_FORMAT(a.attendance_time, '%H:%i') AS formatted_time FROM attendance a 
JOIN class_schedules cs ON a.schedule_id = cs.schedule_id
JOIN student_subjects ss ON cs.subject_id = ss.subject_id AND cs.section_id = ss.section_id 
JOIN subjects sub ON ss.subject_id = sub.subject_id
JOIN students s ON ss.student_id = s.student_id 
JOIN sections ON sections.section_id = cs.section_id
WHERE a.schedule_id = '$scheduleId' 
AND sub.subject_name = '$subjectName' 
AND sections.section_name = '$sectionName'";


$result = $connectNow->query($query);

if ($result->num_rows > 0) {
    $attendanceList = array();
    while ($rowFound = $result->fetch_assoc()) {
        $attendanceList[] = $rowFound;
    }
    echo json_encode(array("success"=>true,"attendance_list_data"=>$attendanceList));
}else{
    echo json_encode(array("success"=>false));
}
$connectNow->close();
?>
