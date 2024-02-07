<?php
require_once 'BaseModel.php';

class BookAuthor extends BaseModel {

    public function create($data) {
        $query = "INSERT INTO book_author (book_id, author_id) VALUES (?, ?)";
        $result = $this->db->insert($query, [$data['book_id'], $data['author_id']]);
       
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}

