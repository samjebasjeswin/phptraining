<?php
header('Content-Type: application/json');


$ipInfo = json_decode(file_get_contents('http://ip-api.com/json/?fields=61439') ,true);
if (!$ipInfo || $ipInfo['status'] != 'success') {
    echo json_encode(["status"=>0,"message"=>"Cannot fetch IP info"]);
    exit;
}

$publicIP = $ipInfo['query'];
$country  = $ipInfo['country'];


if (!in_array($country, ['India','Japan'])) {
    echo json_encode([
        "status"=>0,
        "message"=>"Access denied from $country",
        "ip"=>$publicIP,
        "country"=>$country
    ]);
    exit;
}


echo json_encode([
    "status"=>1,
    "message"=>"Access granted",
    "ip"=>$publicIP,
    "country"=>$country
]);