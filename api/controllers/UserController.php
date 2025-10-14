<?php
include __DIR__ . '/../models/User.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(["status"=>0,"message"=>"Invalid request"]);
            exit;
        }

        $name  = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $file  = $_FILES['photo'] ?? null;

        if (!$name || !$email) {
            echo json_encode(["status"=>0,"message"=>"Name and Email required"]);
            exit;
        }

        $photo = $photo_url = $download_url = null;

        if ($file && $file['error'] === 0) {
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $photo = uniqid() . '.' . $ext;
            $uploadDir = __DIR__ . '/../../uploads/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            if (!move_uploaded_file($file['tmp_name'], $uploadDir . $photo)) {
                echo json_encode(["status"=>0,"message"=>"Failed to upload photo"]);
                exit;
            }

            $baseUrl = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/uploads/';
            $photo_url = $baseUrl . $photo;
            $download_url = $photo_url;
        }

        if ($this->userModel->create($name,$email,$photo,$photo_url,$download_url)) {
            echo json_encode(["status"=>1,"message"=>"User created successfully","name"=>$name,"email"=>$email,"photo"=>$photo,"photo_url"=>$photo_url,"download_url"=>$download_url]);
        } else {
            echo json_encode(["status"=>0,"message"=>"Failed to create user"]);
        }
    }

    public function list() {
        echo json_encode($this->userModel->getAll());
    }
}