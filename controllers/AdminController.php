<?php 

class AdminController 
{
    /**
     * Affiche la page debug.
     * @return void
     */
    public function showDebug() : void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getAllBooks();
        $books = array_slice($books, 0, 20);
        
        $randomBook = $bookManager->getRandomBook();

        $userManager = new UserManager();
        $users = $userManager->getAllUsers();
        $users = array_slice($users, 0, 20);

        $booklist = [];
        foreach($books as $b){
            $actualUser = $userManager->getUserById($b->getCreatedBy());
            $actualUserPfp = $actualUser->getProfilePicture();
            $actualUserUsername = $actualUser->getUsername();
            $booklist[] = 
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

        $view = new View("Debug");
        $view->render("debug", [
            'books'         => $booklist,
            'users'         => $users,
            'randombook'    => $randomBook
        ]);
    }
}