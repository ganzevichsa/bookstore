<?php
require_once __DIR__ . '/../Models/Author.php';

class AuthorRepository {

    protected $model;

    public function __construct() {
        $this->model = new Author();
    }

    public function apiCreate($data) {
        $result = $this->model->create($data);

        return $result;
    }

    public function checkMissingAuthors($authorIds) {
        $missingAuthors = [];
        foreach ($authorIds as $authorId) {
            $authorExists = $this->model->getAuthorById($authorId);
            if (!$authorExists) {
                $missingAuthors[] = $authorId;
            }
        }
        return $missingAuthors;
    }

}

