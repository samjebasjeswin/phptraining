<?php
header('Content-Type: application/json');

$allowedIPs = [
    "103.21.244.0",
    "223.187.114.126",
    "192.168.1.10"  
];


$ipInfo = json_decode(file_get_contents('http://ip-api.com/json/?fields=query'), true);
$userIP = $ipInfo['query'] ?? '';


if (!in_array($userIP, $allowedIPs)) {
    echo json_encode([
        "status" => 0,
        "message" => "Access denied from $userIP"
    ]);
    exit;
}


echo json_encode([
    "status" => 1,
    "message" => "Access granted",
    "ip" => $userIP
]);