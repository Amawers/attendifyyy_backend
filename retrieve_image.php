<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
include("utils/uploads.php");

// $data = json_decode(file_get_contents('php://input'), true);

$user_id = $_GET['teacher_id'];
// $user_id = '16';


if ($user_id != NULL) {
    $uploads = new Uploads();
    $response = $uploads->getImagePath($user_id);

    // Check if the response is valid JSON
    $decodedResponse = json_decode($response);
    if ($decodedResponse !== null) {
        echo $response;
    } else {
        echo json_encode(array("success" => false, "message" => "Invalid response from server"));
    }
} else {
    echo json_encode(array("success" => false, "message" => "No user ID provided"));
}
?>
