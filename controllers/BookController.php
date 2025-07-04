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
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showList() : void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getAllBooks();
        $view = new View("Nos livres");
        $view->render("books-list", ['books' => $books]);
    }
}