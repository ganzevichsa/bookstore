<?php
require_once __DIR__ . '/../Models/Genre.php';

class GenreRepository {

    protected $model;

    public function __construct() {
        $this->model = new Genre();
    }

    public function apiCreate($data) {
        $result = $this->model->create($data);

        return $result;
    }

    public function checkMissingGenres($genreIds) {
        $missingGenres = [];
        foreach ($genreIds as $genreId) {
            $genreExists = $this->model->getById($genreId);
            if (!$genreExists) {
                $missingGenres[] = $genreId;
            }
        }
        return $missingGenres;
    }

}

