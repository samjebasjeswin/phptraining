<?php
class Database {
    private static $instance = null;
    public $conn;

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "mydb"; // your database name

    private function __construct() {
        $this->conn = new mysqli(
            $this->servername,
            $this->username,
            $this->password,
            $this->dbname
        );

        if ($this->conn->connect_error) {
            die(json_encode(["status"=>0,"message"=>"DB Connection failed: ".$this->conn->connect_error]));
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
}
?>