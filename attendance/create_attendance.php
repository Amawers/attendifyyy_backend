<?php
include('../connection.php'); 

// orig
if(isset($_POST['schedule_id'], $_POST['reference_number'])){
    $scheduleId = $_POST['schedule_id'];
    $referenceNumber = $_POST['reference_number'];
}else{
    $response = "wala na received from frontend";
}

// // testing purpose
// $scheduleId = '1';
// $referenceNumber = '2021300656';


$query = "INSERT INTO attendance (schedule_id, attendance_date, attendance_time, attendance_status)
SELECT
    cs.schedule_id,
    CURDATE(),
    CURTIME(),
    'Present'
FROM
    class_schedules cs
JOIN
    student_subjects ss ON cs.subject_id = ss.subject_id AND cs.section_id = ss.section_id
JOIN
    students s ON ss.student_id = s.student_id
WHERE
    cs.schedule_id = '$scheduleId'
    AND s.reference_number = '$referenceNumber'";
    
$result = $connectNow->query($query);

if ($result) {
    $response = "Data inserted successfully";
} else {
    $response = "Error inserting data: " . $connectNow->error;
}

echo json_encode($response);

$connectNow->close();
?>