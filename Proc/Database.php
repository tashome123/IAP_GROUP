<?php
class Database {
    private $conn;
    private $conf;

    public function __construct($conf) {
        $this->conf = $conf;
        $this->connect();
    }

    private function connect() {
        try {
            // Check if port is specified in host
            $host = $this->conf['db_host'];
            if (!str_contains($host, ':')) {
                $host .= ':3307'; // Add default MySQL port
            }
            
            $dsn = "mysql:host={$host};dbname={$this->conf['db_name']};charset=utf8mb4";
            $this->conn = new PDO($dsn, $this->conf['db_user'], $this->conf['db_pass']);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            die("Database connection failed: " . $e->getMessage() . "<br><br>Please check:<br>1. MySQL service is running<br>2. Database credentials in conf.php are correct<br>3. Database '{$this->conf['db_name']}' exists");
        }
    }

    public function query($sql, $params = []) {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch(PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            return false;
        }
    }

    public function fetch($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt ? $stmt->fetch() : false;
    }

    public function fetchAll($sql, $params = []) {
        $stmt = $this->query($sql, $params);
        return $stmt ? $stmt->fetchAll() : false;
    }

    public function insert($table, $data) {
        $keys = array_keys($data);
        $fields = implode(', ', $keys);
        $placeholders = ':' . implode(', :', $keys);

        $sql = "INSERT INTO {$table} ({$fields}) VALUES ({$placeholders})";
        return $this->query($sql, $data);
    }

    public function lastInsertId() {
        return $this->conn->lastInsertId();
    }
}