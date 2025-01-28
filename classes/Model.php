<?php

class Model {
    protected $db;

    public function __construct() {
        require_once __DIR__ . '/../config/database.php';
        $this->db = getDatabaseConnection();
    }

    protected function executeQuery($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
} 