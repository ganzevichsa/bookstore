<?php
require_once 'BaseModel.php';

class Book extends BaseModel {

    public function list($filter = []) {
        $query = "SELECT books.id AS book_id, books.title AS book_title, books.published_year AS book_year, GROUP_CONCAT(authors.name SEPARATOR ', ') AS authors_list
            FROM books
            JOIN book_author ON books.id = book_author.book_id
            JOIN authors ON book_author.author_id = authors.id";

        if (!empty($filter['author'])) {
            $query .= " AND authors.name = ?";
            $params[] = $filter['author'];
        }
    
        if (!empty($filter['year'])) {
            $query .= " AND books.published_year = ?";
            $params[] = $filter['year'];
        }
    
        $query .= " GROUP BY books.id LIMIT 20";

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

