<?php
require_once __DIR__ . '/../../Repositories/AuthorRepository.php';
require_once 'BaseApiController.php';

class AuthorController extends BaseApiController{

    public function __construct() {
        parent::__construct('AuthorRepository');
    }

    public function store() {
        $data['name'] = $_POST['name'] ?? null;

        if (empty($data['name'])) {
            $this->jsonResponse(['error' => 'Name field is required'], 400);
            return;
        }

        $result = $this->repository->apiCreate($data);

        if ($result) {
            $this->jsonResponse(['message' => 'Author created successfully', 'data' => $result], 201);
        } else {
            $this->jsonResponse(['error' => 'Failed to create author'], 500);
        }
    }
}
?>
