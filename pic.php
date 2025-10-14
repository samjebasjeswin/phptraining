<?php
include 'db.php';
header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name  = $_POST['name'] ?? '';
    $photo = $_POST['photo'] ?? ''; 

    if ($name == '' || $photo == '') {
        echo json_encode(["status"=>0, "message"=>"Name and photo path are required"]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO pic (name, photo) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $photo);

    if ($stmt->execute()) {
        echo json_encode(["status"=>1, "message"=>"Photo path added successfully"]);
    } else {
        echo json_encode(["status"=>0, "message"=>"Database error: " . $conn->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["status"=>0, "message"=>"Invalid request method"]);
}
?>