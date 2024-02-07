<?php
require_once '../core/Database.php';
require_once 'BaseModel.php';

class Genre extends BaseModel {

    public function create($data) {
        $query = "INSERT INTO genres (name) VALUES (?)";
        $result = $this->db->insert($query, [$data['name']]);
       
        if ($result) {
            $genreId = $this->db->lastInsertId();
            $genre = $this->getById($genreId);
            if ($genre) {
                return $genre;
            }else{
                return false;
            }
        } else {
            return false;
        }
    }

    public function getById($genreId) {
        $query = "SELECT * FROM genres WHERE id = ?";
        $genre = $this->db->queryOne($query, [$genreId]);
        
        return $genre;
    }
}

