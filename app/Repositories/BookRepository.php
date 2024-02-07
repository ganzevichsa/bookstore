<?php
require_once __DIR__ . '/../Models/Book.php';
require_once __DIR__ . '/../Models/BookAuthor.php';
require_once __DIR__ . '/../Models/BookGenre.php';

class BookRepository {

    protected $model;

    public function __construct() {
        $this->model = new Book();
    }

    public function list($filter = []) {
        $books = $this->model->list($filter);

        return $books;
    }

    public function apiCreate($data) {
        $result = $this->model->create($data);

        return $result;
    }

    public function createAuthorBook($data) {
        $book_author = new BookAuthor();
        $result = $book_author->create($data);

        return $result;
    }

    public function createGenreBook($data) {
        $book_author = new BookGenre();
        $result = $book_author->create($data);

        return $result;
    }

}

