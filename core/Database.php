<?php

/**
 * Класс обрабатывает подключение к базе данных и логирование ошибок.
 */
class Database {
    protected $db;
    protected $errorLogDatabase = 'error.log'; // файл журнала ошибок

    /**
     * Конструктор класса. Установка подключения к базе данных.
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

    /**
     * Метод выполнения запроса.
     */
    public function query($sql, $params = []) {
        try {
            // Подготовка и выполнение запроса
            $statement = $this->db->prepare($sql);
            $statement->execute($params);
            
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            $this->logError($e->getMessage());
            return false;
        }
    }

    public function queryOne($sql, $params = []) {
        try {
            $statement = $this->db->prepare($sql);
            $statement->execute($params);
           
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            $this->logError($e->getMessage());

            return false;
        }
    }

    public function insert($sql, $params = []) {
        try {
            $statement = $this->db->prepare($sql);
            $result = $statement->execute($params);

            return $result;
        } catch(PDOException $e) {
            $this->logError($e->getMessage());

            return false;
        }
    }

    public function lastInsertId(){
        return $this->db->lastInsertId();
    }

    protected function logError($message) {
        error_log($message . "\n", 3, $this->errorLogDatabase);
    }
}