<?php
include('../connection.php'); 

$teacherId = $_GET['teacher_id'];

// //testing purpose
// $teacherId  = '8';

$query = "SELECT first_name, last_name, email, phone_number, department FROM teachers WHERE teachers.teacher_id = '$teacherId'";

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