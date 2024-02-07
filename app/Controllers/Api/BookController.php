<?php
require_once __DIR__ . '/../../Repositories/BookRepository.php';
require_once __DIR__ . '/../../Repositories/AuthorRepository.php';
require_once __DIR__ . '/../../Repositories/GenreRepository.php';
require_once 'BaseApiController.php';

class BookController extends BaseApiController{

    public function __construct() {
        parent::__construct('BookRepository');
    }

    public function store() {
        $data['title'] = $_POST['title'] ?? null;
        $data['published_year'] = $_POST['published_year'] ?? null;
        $data['authors'] = $_POST['authors'] ?? [];
        $data['genres'] = $_POST['genres'] ?? [];

        if (empty($data['title'])) {
            $this->jsonResponse(['error' => 'Title field is required'], 400);
            return;
        }

        if (strlen($data['title']) > 30) {
            $this->jsonResponse(['error' => 'Title field must be maximum 30 characters'], 400);
            return;
        }

        if (empty($data['published_year'])) {
            $this->jsonResponse(['error' => 'Year field is required'], 400);
            return;
        }

        if (!is_numeric($data['published_year']) || strlen($data['published_year']) !== 4) {
            $this->jsonResponse(['error' => 'Published year must be a valid year'], 400);
            return;
        }

        if (empty($data['authors'])) {
            $this->jsonResponse(['error' => 'Authors field is required'], 400);
            return;
        }
    
        if (empty($data['genres'])) {
            $this->jsonResponse(['error' => 'Genres field is required'], 400);
            return;
        }

        $authorRepository = new AuthorRepository();
        $missingAuthors = $authorRepository->checkMissingAuthors($data['authors']);

        if (!empty($missingAuthors)) {
            $this->jsonResponse(['error' => 'Some authors do not exist'], 400);
            return;
        }

        $genresRepository = new GenreRepository();
        $missingGenres = $genresRepository->checkMissingGenres($data['genres']);

        if (!empty($missingGenres)) {
            $this->jsonResponse(['error' => 'Some genres do not exist'], 400);
            return;
        }

        $result = $this->repository->apiCreate($data);



        if ($result) {
            $data_new['book_id'] = $result['id'];

            foreach ($data['authors'] as $authorId) {
                $data_new['author_id'] = $authorId;

                $this->repository->createAuthorBook($data_new);
            }

            foreach ($data['genres'] as $genreId) {
                $data_new['genre_id'] = $genreId;

                $this->repository->createGenreBook($data_new);
            }

            $this->jsonResponse(['message' => 'Book created successfully', 'data' => $result], 201);
        } else {
            $this->jsonResponse(['error' => 'Failed to create book'], 500);
        }
    }
}
?>
