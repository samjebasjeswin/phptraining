<?php
include 'db.php';
header('Content-Type: application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$createTable = "CREATE TABLE IF NOT EXISTS usr (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    photo VARCHAR(100),
    photo_url VARCHAR(255),
    download_url VARCHAR(255)
)";
$conn->query($createTable);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status"=>0,"message"=>"Invalid request"]);
    exit;
}

$name  = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';

if (!$name || !$email) {
    echo json_encode(["status"=>0,"message"=>"Name and Email are required"]);
    exit;
}

$photo_path = $photo_url = $download_url = null;

if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
    $photo_name = uniqid() . '.' . $ext;
    $upload_dir = __DIR__ . '/uploads/';
    
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true); 
    }
    
    $photo_path = 'uploads/' . $photo_name;
    
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $upload_dir . $photo_name)) {
        $base_url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/training/';
        $photo_url = $base_url . $photo_path;
        $download_url = $base_url . 'download.php?file=' . urlencode($photo_name);
    } else {
        echo json_encode(["status"=>0,"message"=>"Failed to upload photo"]);
        exit;
    }
}

$sql = "INSERT INTO usr (name, email, photo, photo_url, download_url) 
        VALUES ('$name', '$email', '$photo_path', '$photo_url', '$download_url')";

if ($conn->query($sql)) {
    echo json_encode([
        "status" => 1,
        "message" => "User created successfully",
        "name" => $name,
        "email" => $email,
        "photo" => $photo_path,
        "photo_url" => $photo_url,
        "download_url" => $download_url
    ]);
} else {
    echo json_encode(["status"=>0,"message"=>$conn->error]);
}
?>