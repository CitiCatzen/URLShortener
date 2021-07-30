<?php

namespace Configs;

use PDO;
use PDOException;

class Database {
    private string $host = "";
    private string $db_name = "";
    private string $username = "";
    private string $password = "";
    private $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
