


<?php
include 'db.php'; 
header('Content-Type: application/json'); 


$perPage = 3;


$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;


$startAt = ($page - 1) * $perPage;


$result = $conn->query("SELECT COUNT(*) AS total FROM usr");
$row = $result->fetch_assoc();
$totalUsers = $row['total'];


$totalPages = ceil($totalUsers / $perPage);


$sql = "SELECT * FROM usr LIMIT $startAt, $perPage";
$result = $conn->query($sql);

$users = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

echo json_encode([
    'currentPage' => $page,
    'totalPages' => $totalPages,
    'users' => $users
]);
?>