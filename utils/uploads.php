<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
class Uploads{
    private $respond;

    public function uploadImage(string $user_image, string $user_id)
    {

       $path = "users/$user_id";
       
       if(!file_exists($path))
       {
          mkdir($path);
       }

       $file_name = rand();
       $output_file_path = $path ."/$file_name.jpg";
       $file_handler = fopen($output_file_path, 'wb');
       fwrite($file_handler, base64_decode($user_image));
       fclose($file_handler);

       if(file_exists($output_file_path))
       {
          $serverHost = "localhost";
          $user = "root";
          $password = "";
          $database = "attendifyyy";
        
          $connectNow = new mysqli($serverHost, $user, $password, $database);
          $query = "UPDATE teachers SET profile_pic_path = '$output_file_path' WHERE teachers.teacher_id = '$user_id'";
          $result = $connectNow->query($query);
          $this->respond = array(
            "status" => 1,
          );
       }else{
          $this->respond = array(
            "status" => 0,
          );
       }

       return json_encode($this->respond);
    }

    public function getImagePath(string $user_id){
        $serverHost = "localhost";
        $user = "root";
        $password = "";
        $database = "attendifyyy";

        $connectNow = new mysqli($serverHost, $user, $password, $database);

        $query = "SELECT profile_pic_path FROM teachers WHERE teacher_id = '$user_id'";
        $result = $connectNow->query($query);

        if ($result && $row = $result->fetch_assoc()) {
            $this->respond = array(
                "success" => true,
                "image_path" => $row['profile_pic_path']
            );
        } else {
            $this->respond = array(
                "success" => false,
                "image_path" => "Walay path"
            );
        }

        return json_encode($this->respond);
    }
}