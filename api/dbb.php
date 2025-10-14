<?php
class Database {
    private static $instance = null;
    public $conn;

    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db   = "mydb";

    private function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
}