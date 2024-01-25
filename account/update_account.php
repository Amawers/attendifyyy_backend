<?php
include('../connection.php'); 
$input_data = file_get_contents('php://input');

parse_str($input_data, $decoded_data);

if(isset($decoded_data['teacher_id'], $decoded_data['first_name'], $decoded_data['last_name'], $decoded_data['email'], $decoded_data['phone_number'], $decoded_data['department'])){
    $teacherId = $decoded_data['teacher_id'];
    $firstName = $decoded_data['first_name'];
    $lastName = $decoded_data['last_name'];
    $email = $decoded_data['email'];
    $phoneNumber = $decoded_data['phone_number'];
    $department = $decoded_data['department'];
}else{
    $response = "wala na received diri sa backend ang mga values";
}

// testing
// $teacherId = '17';
// $firstName = 'Jay Noel';
// $lastName = 'Rojo';
// $email = 'rojo@gmail.com';
// $phoneNumber = '09797475869';
// $department = 'IT';

$query = "UPDATE teachers 
SET first_name = '$firstName', 
last_name = '$lastName',
email = '$email',
phone_number = '$phoneNumber',
department = '$department' WHERE teacher_id = '$teacherId'";

$result = $connectNow->query($query);


if ($result) {
    echo json_encode(array("success"=>true));
} else {
    echo json_encode(array("success"=>false));
}
$connectNow->close();
?>
