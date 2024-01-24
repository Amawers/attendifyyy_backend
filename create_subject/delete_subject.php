<?php
include('../connection.php'); 
$input_data = file_get_contents('php://input');

parse_str($input_data, $decoded_data);

$subjectId = $decoded_data['subject_id'];
$sectionId = $decoded_data['section_id'];

$query = "DELETE FROM subject_teachers WHERE subject_id = '$subjectId' AND section_id = '$sectionId'";
$result = $connectNow->query($query);


if ($result) {
    echo json_encode(array("success"=>true));
} else {
    echo json_encode(array("success"=>false));
}
$connectNow->close();
?>
