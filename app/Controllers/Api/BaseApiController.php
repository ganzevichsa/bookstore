<?php

abstract class BaseApiController {

    protected $repository;
    
    /**
     * Метод-конструктор.
     */
    public function __construct($repository) {
        $this->repository = new $repository();
    }

    protected function jsonResponse($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
?>
