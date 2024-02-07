<?php

require_once __DIR__ . '/../Repositories/BookRepository.php';
require_once 'BaseController.php';

class BookController extends BaseController {

    public function __construct() {
        parent::__construct('BookRepository');
    }

    public function list() {
        
        $filter = [
            'author' => $_GET['author'] ?? null,
            'year' => $_GET['year'] ?? null
        ];

        $books = $this->repository->list($filter);

        $this->view('book-list', ['books' => $books]);
    }

}
