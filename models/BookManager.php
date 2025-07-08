<?php

/**
 * Classe qui gère les livres.
 */
class BookManager extends AbstractEntityManager 
{

    public function getAllBooks() : array
    {
        $sql = "SELECT * FROM books";
        $result = $this->db->query($sql);
        $books = [];
        while ($book = $result->fetch()) {
            $books[] = new Book($book);
        }
        return $books;
    }
    
    public function getBookById(int $id) : ?Book
    {
        $sql = "SELECT * FROM books WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $book = $result->fetch();
        if ($book) {
            return new Book($book);
        }
        return null;
    }

    public function getRandomBook() : ?Book
    {

        $sql = "SELECT * FROM books ORDER BY RAND() LIMIT 1";
        $result = $this->db->query($sql);
        $book = $result->fetch(PDO::FETCH_ASSOC);
        if ($book) {
            return new Book($book);
        }
        return null;
    }

    public function getLastBooks(int $nbOfBooks) : ?array 
    {
        $sql = "SELECT * FROM books ORDER BY created_at DESC LIMIT $nbOfBooks";
        $result = $this->db->query($sql);
        $books = [];
        while ($book = $result->fetch()) {
            $books[] = new Book($book);
        }
        return $books;
    }

}