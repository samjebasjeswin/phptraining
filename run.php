<?php
require_once 'Cal.php';

$calculator = new Calculator();


$calculator->setNumbers(10, 5);


echo "Add: " . $calculator->add() . PHP_EOL;
echo "Subtract: " . $calculator->subtract() . PHP_EOL;
?>