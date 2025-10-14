<?php
include __DIR__ . '/../dbb.php';

class User {
    private $conn;
    private $table = "abc";  // New table name

    public function __construct() {
        $this->conn = Database::getInstance()->conn;
        $this->createTable();
    }

    private function createTable() {
        $sql = "CREATE TABLE IF NOT EXISTS {$this->table} (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            photo VARCHAR(100),
            photo_url VARCHAR(255),
            download_url VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $this->conn->query($sql);
    }

    public function create($name, $email, $photo = null, $photo_url = null, $download_url = null) {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (name,email,photo,photo_url,download_url) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss", $name, $email, $photo, $photo_url, $download_url);
        return $stmt->execute();
    }

    public function getAll() {
        $result = $this->conn->query("SELECT * FROM {$this->table} ORDER BY id DESC");
        $users = [];
        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $users[] = $row;
            }
        }
        return $users;
    }
}