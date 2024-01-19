<?php
include('../connection.php');

// orig
$teacherId = $_POST['teacher_id'];
$subjectName = $_POST['subject_name'];

// testing purpose
// $teacherId = '8';

$query = "SELECT class_schedules.schedule_id 
FROM class_schedules WHERE class_schedules.teacher_id = '$teacherId'";
$result = $connectNow->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $scheduleId = $row['schedule_id'];
} else {
    echo 'error kuha subject_id';
}

// $query = "SELECT sub.subject_name, s.first_name, s.last_name, attendance.attendance_status, CURRENT_DATE(), TIME_FORMAT(attendance.attendance_time, '%H:%i') AS formatted_time
// FROM attendance, class_schedules cs JOIN student_subjects ss ON cs.subject_id = ss.subject_id AND cs.section_id = ss.section_id
// JOIN subjects sub ON ss.subject_id = sub.subject_id
// JOIN students s ON ss.student_id = s.student_id WHERE attendance.schedule_id = '$scheduleId' AND sub.subject_name = '$subjectName'";

$query = "SELECT sub.subject_name, s.first_name, s.last_name, a.attendance_status, CURRENT_DATE() AS attendance_date, 
TIME_FORMAT(a.attendance_time, '%H:%i') AS formatted_time FROM attendance a JOIN class_schedules cs ON a.schedule_id = cs.schedule_id
JOIN student_subjects ss ON cs.subject_id = ss.subject_id AND cs.section_id = ss.section_id JOIN subjects sub ON ss.subject_id = sub.subject_id
JOIN students s ON ss.student_id = s.student_id WHERE a.schedule_id = '$scheduleId' AND sub.subject_name = '$subjectName'";


$result = $connectNow->query($query);

if ($result->num_rows > 0) {
    $attendanceList = array();
    while ($rowFound = $result->fetch_assoc()) {
        $attendanceList[] = $rowFound;
    }
    echo json_encode($attendanceList);
} 
$connectNow->close();
?>
