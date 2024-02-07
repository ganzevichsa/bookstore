<?php
require_once __DIR__ . '/../../core/Database.php';

abstract class BaseModel {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }
}