<?php
require_once 'BaseModel.php';

class Book extends BaseModel {

    public function list($filter = []) {
        $query = "SELECT books.*, genres.name as genre_name 
                FROM books 
                -- LEFT JOIN genres ON books.genre_id = genres.id 
                WHERE 1";
    
        if (!empty($filter['genre'])) {
            $query .= " AND genres.name = ?";
            $params[] = $filter['genre'];
        }
    
        if (!empty($filter['year'])) {
            $query .= " AND books.year = ?";
            $params[] = $filter['year'];
        }
    
        $query .= " GROUP BY books.id";
    
        return $this->db->query($query, $params ?? []);
    }

    public function create($data) {
        $query = "INSERT INTO books (title, published_year) VALUES (?, ?)";
        $result = $this->db->insert($query, [$data['title'], $data['published_year']]);
       
        if ($result) {
            $bookId = $this->db->lastInsertId();
            $book = $this->getById($bookId);
            if ($book) {
                return $book;
            }else{
                return false;
            }
        } else {
            return false;
        }
    }

    public function getById($genreId) {
        $query = "SELECT * FROM books WHERE id = ?";
        $genre = $this->db->queryOne($query, [$genreId]);
        
        return $genre;
    }

}

