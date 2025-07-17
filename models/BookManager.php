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

    public function getLastBook() : ?Book
    {
        $sql = "SELECT * FROM books ORDER BY id DESC LIMIT 1";
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
   
    public function getBooksByUser(int $created_by) : ?array
    {
        $sql = "SELECT * FROM books WHERE created_by = :created_by";
        $result = $this->db->query($sql, ['created_by' => $created_by]);
        $books = [];
        while ($book = $result->fetch()) {
            $books[] = new Book($book);
        }
        return $books;
    }

    public function countBooksByUser(int $created_by): int
    {
        $sql = "SELECT COUNT(*) as count FROM books WHERE created_by = :created_by";
        $result = $this->db->query($sql, ['created_by' => $created_by]);
        $data = $result->fetch();
        return (int) $data['count'];
    }

    public function addBook(string $title, string $author, $cover_image = null, string $description, string $status, int $created_by) : void
    {
        $sql = "INSERT INTO books (title, author, cover_image, description, status, created_by) VALUES (:title, :author, :cover_image, :description, :status, :created_by)";
        $this->db->query($sql, [
            'title'         =>  $title,
            'author'        =>  $author,
            'cover_image'   =>  $cover_image,
            'description'   =>  $description,
            'status'        =>  $status,
            'created_by'    =>  $created_by
        ]);
    }
    public function deleteBook(Book $book) : bool
    {
        $sql = "DELETE FROM books WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $book->getId()]);
        return $result->rowCount() > 0;
    }
}