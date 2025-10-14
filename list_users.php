<?php
include 'db.php';

header('Content-Type: application/json');

$sql = "SELECT * FROM user";
$result = $conn->query($sql);

$user = [];
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){

        $user[] = $row;
    }
}

echo json_encode($user);