<?php
include('../connection.php'); 

if(isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch the hashed password from the database based on the provided email
    $query = "SELECT password FROM teachers WHERE email = '$email'";
    $result = $connectNow->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $existingHashFromDb = $row['password'];

        // Check if the provided password matches the stored hashed password
        if (password_verify($password, $existingHashFromDb)) {
            // Passwords match, login successful
            $response = "Login successful";
        } else {
            // Passwords do not match
            $response = "Incorrect password";
        }
    } else {
        // User not found
        $response = "User not found";
    }
} else {
    $response = "Invalid data received";
}

echo json_encode($response);

$connectNow->close();
?>
