<?php

require_once __DIR__ . '/../Repositories/BookRepository.php';
require_once __DIR__ . 'BaseController.php';

class BookController extends BaseController {

    public function __construct() {
        parent::__construct('BookRepository');
    }

    public function list() {
        $filter = [
            'genre' => $_GET['genre'] ?? null;
            'year' => $_GET['year'] ?? null;
        ];

        $book = $this->repository->list($filter);
        $this->view('book-list', ['book' => $book]);
    }

}
