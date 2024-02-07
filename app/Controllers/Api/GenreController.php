<?php
require_once __DIR__ . '/../../Repositories/GenreRepository.php';
require_once 'BaseApiController.php';

class GenreController extends BaseApiController{

    public function __construct() {
        parent::__construct('GenreRepository');
    }

    public function store() {
        $data['name'] = $_POST['name'] ?? null;

        if (empty($data['name'])) {
            $this->jsonResponse(['error' => 'Name field is required'], 400);
            return;
        }

        $result = $this->repository->apiCreate($data);

        if ($result) {
            $this->jsonResponse(['message' => 'Genre created successfully', 'data' => $result], 201);
        } else {
            $this->jsonResponse(['error' => 'Failed to create genre'], 500);
        }
    }
}
?>
