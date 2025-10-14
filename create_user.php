<?php
include 'db.php';

header('Content-Type: application/json'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name  = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    

    if ($name == '' || $email == '') {
        echo json_encode(["status"=>0,"message"=>"Name and Email are required"]);

        exit;
    }

    $sql = "INSERT INTO user (name, email) VALUES ('$name', '$email')";

    if($conn->query($sql)){
        echo json_encode(["status"=>1,"message"=>"User created successfully"]);
    } else {
        echo json_encode(["status"=>0,"message"=>"Error: ".$conn->error]);
    }

} else {
    echo json_encode(["status"=>0,"message"=>"Invalid request"]);
}
?>