<?php
header('Content-Type: application/json');
include __DIR__ . '/controllers/UserController.php';

$controller = new UserController();
$controller->list();