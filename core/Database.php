<?php

/**
 * Класс Database
 * Обрабатывает подключение к базе данных и логирование ошибок.
 */
class Database {
    protected $db;
    protected $errorDatabase = 'error.log'; // файл журнала ошибок

    /**
     * Конструктор класса Database.
     * Установка подключения к базе данных.
     */
    public function __construct() {

        //Параметры подключения
        $host = 'localhost';
        $dbname = 'bookstore';
        $username = 'root';
        $password = '';

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            $this->logError($e->getMessage());
            exit;
        }
    }

    protected function logError($message) {
        error_log($message . "\n", 3, $this->errorLogFile);
    }
}