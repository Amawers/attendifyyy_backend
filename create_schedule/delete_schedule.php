<?php
include('../connection.php'); 
$scheduleId = $_GET['schedule_id'];

$query = "DELETE FROM class_schedules WHERE schedule_id = '$scheduleId'";
$result = $connectNow->query($query);

if ($result) {
    echo json_encode(array("success"=>true));
} else {
    echo json_encode(array("success"=>false));
}
$connectNow->close();
?>
