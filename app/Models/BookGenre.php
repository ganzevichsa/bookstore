<?php
require_once 'BaseModel.php';

class BookGenre extends BaseModel {

    public function create($data) {
        $query = "INSERT INTO book_genre (book_id, genre_id) VALUES (?, ?)";
        $result = $this->db->insert($query, [$data['book_id'], $data['genre_id']]);
       
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}

