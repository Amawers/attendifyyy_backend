<?php
include('../connection.php'); 

// orig
if(isset($_POST['subject_name'], $_POST['reference_number'])){
    $subjectName = $_POST['subject_name'];
    $referenceNumber = $_POST['reference_number'];
}else{
    $response = "wala na received from frontend";
}

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
JOIN 
    subjects ON cs.subject_id = subjects.subject_id
WHERE
    subjects.subject_name ='$subjectName'
    AND s.reference_number = '$referenceNumber'";
    
$result = $connectNow->query($query);

if ($result) {
    echo json_encode(array("success"=>true));
} else {
    echo json_encode(array("success"=>false));
}

echo json_encode($response);

$connectNow->close();
?>