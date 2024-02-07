<?php
require_once '../core/Database.php';
require_once 'BaseModel.php';

class Author extends BaseModel {

    public function create($data) {
        $query = "INSERT INTO authors (name) VALUES (?)";
        $result = $this->db->insert($query, [$data['name']]);
       
        if ($result) {
            $authorId = $this->db->lastInsertId();
            $author = $this->getAuthorById($authorId);
            if ($result) {
                return $author;
            }else{
                return false;
            }
        } else {
            return false;
        }
    }

    private function getAuthorById($authorId) {
        $query = "SELECT * FROM authors WHERE id = ?";
        $author = $this->db->queryOne($query, [$authorId]);
        
        return $author;
    }
}

