<?php
include 'db.php';

$sql = "CREATE TABLE IF NOT EXISTS userr (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    photo VARCHAR(100)
)";


if ($conn->query($sql) === TRUE) {
    echo json_encode(["status"=>1,"message"=>"Table 'users' created successfully"]);
} else {
    echo json_encode(["status"=>0,"message"=>"Error creating table: ".$conn->error]);
}

$conn->close();
?>
