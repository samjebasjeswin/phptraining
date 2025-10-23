<?php
class Calculator {

    private $num1;
    private $num2;


    public function setNumbers($a, $b) {
        $this->num1 = $a;
        $this->num2 = $b;
    }


    public function add() {
        return $this->calculateAdd();
    }

    public function subtract() {
        return $this->calculateSubtract();
    }


    private function calculateAdd() {
        return $this->num1 + $this->num2;
    }

    private function calculateSubtract() {
        return $this->num1 - $this->num2;
    }
}
?>