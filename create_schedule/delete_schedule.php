<?php
include('../connection.php'); 
$scheduleId = $_GET['schedule_id'];

$query = "DELETE FROM class_schedules WHERE schedule_id = '$scheduleId'";
$result = $connectNow->query($query);

echo json_encode($result);
$connectNow->close();
?>
