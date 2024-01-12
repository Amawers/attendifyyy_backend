<?php
include('../connection.php'); 

if(isset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'], $_POST['phone_number'], $_POST['department'])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phoneNumber = $_POST['phone_number'];
    $department = $_POST['department'];

    $query = "INSERT INTO teachers (first_name, last_name, email, password, phone_number, department) 
              VALUES ('$firstName', '$lastName', '$email', '$password', '$phoneNumber', '$department')";

    $result = $connectNow->query($query);

    if ($result) {
        $response = "Data inserted successfully";
    } else {
        $response = "Error inserting data: " . $connectNow->error;
    }
} else {
    $response = "Invalid data received";
}

echo json_encode($response);

$connectNow->close();
?>
