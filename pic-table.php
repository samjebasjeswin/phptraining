<?php
include 'db.php'; 


$sql = "CREATE TABLE  pic (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    photo VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["status"=>1, "message"=>"Table 'pic' created successfully"]);
} else {
    echo json_encode(["status"=>0, "message"=>"Error creating table: " . $conn->error]);
}
?>