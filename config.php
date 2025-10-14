<?php

$env = parse_ini_file('.env');


$db_host = $env['DB_HOST'];
$db_user = $env['DB_USER'];
$db_pass = $env['DB_PASS'];
$db_name = $env['DB_NAME'];


    echo "$db_host, $db_user, $db_pass, $db_name";

?>