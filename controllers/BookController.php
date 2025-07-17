<?php 

class BookController 
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome() : void
    {

        $bookManager = new BookManager();
        $books = $bookManager->getLastBooks(4);
        
        $userManager = new UserManager();
        
        $randomBook = $bookManager->getRandomBook();
        $actualUser = $userManager->getUserById($randomBook->getCreatedBy());
        $randomBookId = $actualUser->getId();
        $randomBookUsername = $actualUser->getUsername();
        $randomBookArray = [
            'id'                    => $randomBook->getId(),
            'cover_image'           => $randomBook->getCoverImage(),
            'author'                => $randomBook->getAuthor(),
            'uploader_id'           => $randomBookId,
            'uploader_username'     => $randomBookUsername
        ];

        $lastbooklist = [];
        foreach($books as $b){
            $actualUser = $userManager->getUserById($b->getCreatedBy());
            $actualUserPfp = $actualUser->getProfilePicture();
            $actualUserUsername = $actualUser->getUsername();
            $lastbooklist[] = 
            [
                'id'                    => $b->getId(),
                'cover_image'           => $b->getCoverImage(),
                'title'                 => $b->getTitle(),
                'author'                => $b->getAuthor(),
                'description'           => $b->getDescription(20),
                'creation_date'         => Utils::formatDate($b->getCreatedAt()),
                'uploader_pfp'          => $actualUserPfp,
                'uploader_username'     => $actualUserUsername
            ];
        }        

        $view = new View("Accueil");
        $view->render("home", [
            'books' => $lastbooklist,
            'randombook' => $randomBookArray
        ]);
    }



    public function showList() : void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getAllBooks();
        
        $userManager = new UserManager();

        $books = array_slice($books, 0, 16);
        $booklist = [];
        foreach($books as $b){
            $actualUser = $userManager->getUserById($b->getCreatedBy());
            $actualUserUsername = $actualUser->getUsername();
            $booklist[] = 
            [
                'id'                    => $b->getId(),
                'cover_image'           => $b->getCoverImage(),
                'title'                 => $b->getTitle(),
                'author'                => $b->getAuthor(),
                'uploader_username'     => $actualUserUsername,
                'creation_date'         => $b->getCreatedAt()
            ];
        }
        usort($booklist, fn($a, $b) => $b['creation_date'] <=> $a['creation_date']);

        $view = new View("Nos livres");
        $view->render("books-list", [
            'books' => $booklist
        ]);
    }

    public function showBook() : void
    {
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($_GET['id']);
        
        $userManager = new UserManager();

        $bookUser = $userManager->getUserById($book->getCreatedBy());
        $actualUserUsername = $bookUser->getUsername();

        $bookDetail['id'] = $book->getId();
        $bookDetail['title'] = $book->getTitle();
        $bookDetail['author'] = $book->getAuthor();
        $bookDetail['cover'] = $book->getCoverImage();
        $bookDetail['description'] = $book->getDescription(255);
        $bookDetail['status'] = $book->getStatus();
        $bookDetail['creation_date'] = $book->getCreatedAt();
        $bookDetail['uploader_id'] = $bookUser->getId();
        $bookDetail['uploader_username'] = $bookUser->getUsername();
        $bookDetail['uploader_image'] = $bookUser->getProfilePicture();

        $view = new View("Nos livres");
        $view->render("book-detail", [
            'book' => $bookDetail
        ]);
    }
    public function editBook() : void
    {
        Utils::checkIfUserIsConnected();

        $bookManager = new BookManager();
        $book = $bookManager->getBookById($_GET['id']);
        
        $userManager = new UserManager();

        $bookUser = $userManager->getUserById($book->getCreatedBy());

        $bookDetail['id'] = $book->getId();
        $bookDetail['title'] = $book->getTitle();
        $bookDetail['author'] = $book->getAuthor();
        $bookDetail['cover'] = $book->getCoverImage();
        $bookDetail['description'] = $book->getDescription();
        $bookDetail['status'] = $book->getStatus();
        $bookDetail['creation_date'] = Utils::formatDate($book->getCreatedAt());
        $bookDetail['uploader_id'] = $bookUser->getId();

        $errorMsg = [];
        if($bookDetail['uploader_id'] !== $_SESSION['idUser']){
            Utils::redirect("home");
        } // Gestion erreur si pas le droit de modifier un livre.

        $view = new View("Édition d'un livre");
        $view->render("book-edit", [
            'book' => $bookDetail
        ]);
    }

    public function showPrivacy() : void
    {
        $view = new View("Politique de confidentialité");
        $view->render("privacy");
    }
    public function showLegal() : void
    {
        $view = new View("Mentions légales");
        $view->render("legal");
    }

}