<?php
include('../connection.php'); 

$teacherId = $_GET['teacher_id'];

// //testing purpose
// $teacherId  = '8';

$query = "SELECT DISTINCT
class_schedules.schedule_id,
subjects.subject_name,
sections.section_name,
class_schedules.start_time,
class_schedules.end_time,
class_schedules.day_of_week
FROM 
class_schedules
JOIN subject_teachers ON class_schedules.subject_id = subject_teachers.subject_id
JOIN subjects ON class_schedules.subject_id = subjects.subject_id
JOIN sections ON class_schedules.section_id = sections.section_id
WHERE 
subject_teachers.teacher_id = '$teacherId'";

$result = $connectNow->query($query);

if($result->num_rows > 0) {
    $schedulesList = array();
    while($rowFound = $result->fetch_assoc()) {
        $schedulesList[] = $rowFound;
    }
    echo json_encode($schedulesList);
}
$connectNow->close();
?>