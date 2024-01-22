<?php
include('../connection.php'); 
$input_data = file_get_contents('php://input');
parse_str($input_data, $decoded_data);

if(isset($decoded_data['schedule_id'], $decoded_data['start_time'], $decoded_data['end_time'], $decoded_data['days_of_week'])){
    $scheduleId = $decoded_data['schedule_id'];
    $startTime = $decoded_data['start_time'];
    $endTime = $decoded_data['end_time'];
    $daysOfWeek = $decoded_data['days_of_week'];
}else{
    $response = "wala na received diri sa backend ang mga values";
}

$startTime = substr($startTime, 10, 5);
$endTime = substr($endTime, 10, 5);

$query = "UPDATE class_schedules 
SET start_time = '$startTime', 
end_time = '$endTime', 
day_of_week = '$daysOfWeek'
WHERE schedule_id = '$scheduleId'";

$result = $connectNow->query($query);


if ($result) {
    $response = "Saksespoly apdet";
} else {
    $response = "Error inserting data: " . $connectNow->error;
}
echo json_encode($response);

$connectNow->close();
?>
