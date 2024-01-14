<?php
include('../connection.php'); 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // Fetch the hashed password from the database based on the provided email
    $query = "SELECT * FROM teachers WHERE email = '$email' AND password = '$password'";
    $result = $connectNow->query($query);

    if($result->num_rows > 0) {
        $teacherRecord = array();
        while($rowFound = $result->fetch_assoc()) {
            $teacherRecord[] = $rowFound;
        }
        echo json_encode(
            array(
                "success"=>true,
                "teacherData"=>$teacherRecord[0],
            )
        );
    }else{
        echo json_encode(array("success"=>false));
    }

$connectNow->close();
?>
