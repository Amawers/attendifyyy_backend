<?php
include("utils/uploads.php");

$data = json_decode(file_get_contents('php://input'), true);

$user_image = $data['teacher_image'];
$user_id = $data['teacher_id'];

if($user_image != NULL && $user_id != NULL)
{
    $uploads = new Uploads();
    echo $uploads->uploadImage($user_image, $user_id);
}else{
    echo json_encode("wala nadawat");
}
?>