<?php
include('../connection.php');

$teacherId = $_GET['teacher_id'];

// for testing
// $teacherId = '8';

$query = "SELECT * FROM attendance JOIN class_schedules cs ON attendance.schedule_id = cs.schedule_id JOIN student_subjects ss ON cs.subject_id = ss.subject_id AND cs.section_id = ss.section_id JOIN students s ON ss.student_id = s.student_id WHERE cs.teacher_id = '$teacherId'";

$result = $connectNow->query($query);

if($result->num_rows > 0) {
    $recentAttendanceList = array();
    while($rowFound = $result->fetch_assoc()) {
        $recentAttendanceList[] = $rowFound;
    }
    echo json_encode($recentAttendanceList);
}else{
    echo "nag error sa pag assign array";
}
?>