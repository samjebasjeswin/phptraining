<?php
class Database {
    private $servername = "localhost";
    private $username   = "root";
    private $password   = "";
    private $dbname     = "mydb";
    public  $conn;


    public function __construct() {
        $this->conn = new mysqli(
            $this->servername,
            $this->username,
            $this->password,
            $this->dbname
        );

        if ($this->conn->connect_error) {
            die("Database Connection failed: " . $this->conn->connect_error);
        }
    }


    public function createClassTable() {
        $sql = "CREATE TABLE IF NOT EXISTS class (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            class_name VARCHAR(100) NOT NULL,
            section VARCHAR(50),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        if ($this->conn->query($sql) === TRUE) {
            echo " Table 'class' created successfully";
        } else {
            echo " Error creating table: " . $this->conn->error;
        }
    }


    public function closeConnection() {
        $this->conn->close();
    }
}


$db = new Database();
$db->createClassTable();
$db->closeConnection();
?>