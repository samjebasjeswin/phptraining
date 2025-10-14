<?php
$name = "sam jebas jeswin";
$words = explode(" ", $name);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($page < 1) $page = 1;
if ($page > count($words)) $page = count($words);

echo $words[$page - 1];


?>