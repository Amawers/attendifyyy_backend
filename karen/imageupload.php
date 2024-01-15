<?php

include('dbconnection.php');
$con=dbconnection();

$cap = $cap=$_POST["caption"];
$data = $_POST["data"];
$name = $name=$_POST["name"];

$path = "upload/$name";

$query = "INSERT INTO `table_image` (`caption`, `image_path`) VALUES ('$cap', '$path')";

// Assuming $connectNow is the database connection object
if ($connectNow->query($query) === TRUE) {
    file_put_contents($path, base64_decode($data));
    echo "Image uploaded successfully.";
} else {
    echo "Error: " . $query . "<br>" . $connectNow->error;
}

?>
