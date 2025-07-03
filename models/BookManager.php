<?php

/**
 * Classe qui gère les livres.
 */
class BookManager extends AbstractEntityManager 
{
    /**
     * Récupère tous les livres.
     * @return array : un tableau d'objets Book.
     */
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
    
    /**
     * Récupère un livre par son id.
     * @param int $id : l'id de l'article.
     * @return Book|null : un objet Article ou null si l'article n'existe pas.
     */
    public function getBookById(int $id) : ?Book
    {
        $sql = "SELECT * FROM book WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $book = $result->fetch();
        if ($book) {
            return new Book($book);
        }
        return null;
    }

    // /**
    //  * Ajoute ou modifie un livre.
    //  * On sait si le livre est un nouveau livre car son id sera -1.
    //  * @param Book $book : le livre à ajouter ou modifier.
    //  * @return void
    //  */
    // public function addOrUpdateBook(Book $book) : void 
    // {
    //     if ($book->getId() == -1) {
    //         $this->addBook($book);
    //     } else {
    //         $this->updateBook($book);
    //     }
    // }

    // /**
    //  * Ajoute un livre.
    //  * @param Book $book : le livre à ajouter.
    //  * @return void
    //  */ // A VOIR !!!!!
    // public function addBook(Book $book) : void
    // {
    //     $sql = "INSERT INTO book (id_user, title, content, date_creation) VALUES (:id_user, :title, :content, NOW())";
    //     $this->db->query($sql, [
    //         'id_user' => $article->getIdUser(),
    //         'title' => $article->getTitle(),
    //         'content' => $article->getContent()
    //     ]);
    // }

    // /**
    //  * Modifie un article.
    //  * @param Article $article : l'article à modifier.
    //  * @return void
    //  */
    // public function updateArticle(Article $article) : void
    // {
    //     $sql = "UPDATE article SET title = :title, content = :content, date_update = NOW() WHERE id = :id";
    //     $this->db->query($sql, [
    //         'title' => $article->getTitle(),
    //         'content' => $article->getContent(),
    //         'id' => $article->getId()
    //     ]);
    // }

    // /**
    //  * Supprime un article.
    //  * @param int $id : l'id de l'article à supprimer.
    //  * @return void
    //  */
    // public function deleteArticle(int $id) : void
    // {
    //     $sql = "DELETE FROM article WHERE id = :id";
    //     $this->db->query($sql, ['id' => $id]);
    // }
}