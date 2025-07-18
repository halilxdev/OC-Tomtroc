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

    public function showList(): void
    {
        $bookManager = new BookManager();
        $userManager = new UserManager();

        $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : null;

        if ($searchTerm) {
            $books = $bookManager->searchBooksByTitle($searchTerm);
        } else {
            $books = $bookManager->getAllBooks();
        }

        $books = array_slice($books, 0, 16);

        $booklist = [];
        foreach ($books as $b) {
            $actualUser = $userManager->getUserById($b->getCreatedBy());
            $booklist[] = [
                'id'                => $b->getId(),
                'cover_image'       => $b->getCoverImage(),
                'title'             => $b->getTitle(),
                'author'            => $b->getAuthor(),
                'uploader_username' => $actualUser->getUsername(),
                'creation_date'     => $b->getCreatedAt()
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

        $view = new View("{$bookDetail['title']}");
        $view->render("book-detail", [
            'book' => $bookDetail
        ]);
    }
    public function showEditBook() : void
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

        if($bookDetail['uploader_id'] !== $_SESSION['idUser']){
            Utils::redirect("home");
        }

        $view = new View("Édition d'un livre");
        $view->render("book-edit", [
            'book' => $bookDetail
        ]);
    }
    public function editBook() : void
    {
        Utils::checkIfUserIsConnected();

        // Récupération du livre actuel
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($_GET['id']);
        
        // Uploader du livre
        $userManager = new UserManager();
        $bookUser = $userManager->getUserById($book->getCreatedBy());

        // Anciennes infos du livre
        $bookDetail['id'] = $book->getId();
        $bookDetail['title'] = $book->getTitle();
        $bookDetail['author'] = $book->getAuthor();
        $bookDetail['cover'] = $book->getCoverImage();
        $bookDetail['description'] = $book->getDescription();
        $bookDetail['status'] = $book->getStatus();
        $bookDetail['creation_date'] = Utils::formatDate($book->getCreatedAt());
        $bookDetail['uploader_id'] = $bookUser->getId();

        // Vérification si auteur = bon
        if($bookDetail['uploader_id'] !== $_SESSION['idUser']){
            Utils::redirect("home");
        }

        // Récupération conditionnelle des champs du formulaire
        if (null !== Utils::request("title")) {
            $titleInput = Utils::request("title");
        }else{
            $titleInput = $bookDetail['title'];
        }

        if (null !== Utils::request("author")) {
            $authorInput = Utils::request("author");
        }else{
            $authorInput = $bookDetail['author'];
        }

        if (null !== Utils::request("description")) {
            $descriptionInput = Utils::request("description");
        }else{
            $descriptionInput = $bookDetail['description'];
        }

        if (null !== Utils::request("status")) {
            $statusInput = Utils::request("status");
        }else{
            $statusInput = $bookDetail['status'];
        }


        if (isset($_FILES['bookCoverUpdate']) && $_FILES['bookCoverUpdate']['error'] === UPLOAD_ERR_OK) {
            $fileTmp = $_FILES['bookCoverUpdate']['tmp_name'];
            $fileName = $_FILES['bookCoverUpdate']['name'];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $newFileName = uniqid("bookCover_") . "." . $fileExt;
            move_uploaded_file($fileTmp, "./public/images/books/" . $newFileName);
            $bookCover = "public/images/books/" . $newFileName;
        }else{
            $bookCover = $bookDetail['cover'];
        }

        // MAJ livre
        $bookManager->updateBook($bookDetail['id'], $titleInput, $authorInput, $bookCover, $descriptionInput, $statusInput);

        // Redirection OK
        Utils::redirect("book-detail", ['id' => $bookDetail['id']]);
    }

    public function showAddBook() : void
    {
        Utils::checkIfUserIsConnected();
        $view = new View("Ajout d'un livre");
        $view->render("book-add");
    }

    public function addBook() : void
    {
        Utils::checkIfUserIsConnected();

        $userManager = new UserManager();
        $uploader = $userManager->getUserById($_SESSION['idUser']);
        $uploaderId = $uploader->getId();
        if (null !== Utils::request("title")) {
            $titleInput = Utils::request("title");
        }
        if (null !== Utils::request("author")) {
            $authorInput = Utils::request("author");
        }
        if (null !== Utils::request("desc")) {
            $descInput = Utils::request("desc");
        }
        if (null !== Utils::request("status")) {
            $statusInput = Utils::request("status");
            if (!in_array($statusInput, ["available", "unavailable"])) {
                $statusInput = "available";
            }
        }
        if (isset($_FILES['bookCoverAdd']) && $_FILES['bookCoverAdd']['error'] === UPLOAD_ERR_OK) {
            $fileTmp = $_FILES['bookCoverAdd']['tmp_name'];
            $fileName = $_FILES['bookCoverAdd']['name'];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $newFileName = uniqid("bookCover_") . "." . $fileExt;
            move_uploaded_file($fileTmp, "./public/images/books/" . $newFileName);
            $bookCover = "public/images/books/" . $newFileName;
        }else{
            $bookCover = 'https://dhmckee.com/wp-content/uploads/2018/11/defbookcover-min.jpg';
        }
        $bookManager = new BookManager();
        $bookManager->addBook($titleInput, $authorInput, $bookCover, $descInput, $statusInput, $uploaderId);
        $lastBook = $bookManager->getLastBook();
        $lastBookId = $lastBook->getId();
        Utils::redirect("book-detail", ['id' => $lastBookId]);
    }

    public function deleteBook() : void
    {
        Utils::checkIfUserIsConnected();
        $id = Utils::request("id", -1);
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);
        if (!$book) {
            throw new Exception("Le livre n'existe pas n'existe pas.");
        }
        $bookManager->deleteBook($book);
        Utils::redirect("home");
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