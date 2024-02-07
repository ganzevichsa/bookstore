<?php
require_once 'BaseModel.php';

class Book extends BaseModel {

    public function list($filter = []) {
        $query = "SELECT books.*, genres.name as genre_name 
                FROM books 
                LEFT JOIN genres ON books.genre_id = genres.id 
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

}

