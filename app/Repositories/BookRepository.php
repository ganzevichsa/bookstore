<?php
require_once __DIR__ . '/../Models/Book.php';

class BookRepository {

    protected $model;

    public function __construct() {
        $this->model = new Book();
    }

    public function list($filter = []) {
        $books = $this->model->list();
    }

}

