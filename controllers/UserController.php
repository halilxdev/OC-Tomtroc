<?php 

class UserController 
{

    public function showLogin(string $errors = '') : void
    {
        if (empty($errors) && isset($_GET['error'])) {
            $errors = htmlspecialchars($_GET['error']); // sécurité
        }
        $view = new View("Connexion");
        $view->render("login", [
            'errorMsg' => $errors
        ]);
    }

    public function showSignup(string $errors = '') : void
    {
        if (empty($errors) && isset($_GET['error'])) {
            $errors = htmlspecialchars($_GET['error']); // sécurité
        }
        $view = new View("Inscription");
        $view->render("signup", [
            'errorMsg' => $errors
        ]);
    }

    public function showProfile() : void
    {
        if(isset($_GET['id'])){
            $askedId = $_GET['id'];

            $userManager = new UserManager();
            $user = $userManager->getUserById($_GET['id']);
            $user_id = $user->getId();
            $user_username = $user->getUsername();

            $bookManager = new BookManager();
            $profileBooks = $bookManager->getBooksByUser($user_id);

            $user = [
                'id'            => $user->getId(),
                'username'      => $user->getUsername(),
                'image'         => $user->getProfilePicture(),
                'email'         => $user->getEmail(),
                'creation_date' => Utils::formatDate($user->getCreatedAt()),
                'since'         => Utils::memberSince($user->getCreatedAt()),
                'nb_books'      => $bookManager->countBooksByUser($user_id)
            ];

            $booksArray = [];
            foreach($profileBooks as $b){
                $booksArray[] = [
                    'id'            => $b->getId(),
                    'image'         => $b->getCoverImage(),
                    'title'         => $b->getTitle(),
                    'status'        => $b->getStatus(),
                    'author'        => $b->getAuthor(),
                    'description'   => $b->getDescription(100)
                ];
            }
        }

        $view = new View("{$user_username}");

        if(isset($_SESSION['user'])){
            $userId = $_SESSION['idUser'];
            
        }

        
        if((isset($userId)) && ($askedId == $userId)){
            $view->render("my-profile", [
            'user' => $user,
            'user_books' => $booksArray
        ]);
        }else{
            $view->render("see-profile", [
                'user' => $user,
                'user_books' => $booksArray
            ]);
        }
    }

    public function connectUser() : void 
    {
        $email = Utils::request("email");
        $password = Utils::request("password");
        $errorMsg = '';

        if (empty($email) || empty($password)) {
            $errorMsg = "incomplete-fields";
        }else{
            $userManager = new UserManager();
            $user = $userManager->getUserByLogin($email);
            if (!$user) {
                $errorMsg = "user-doesnt-exist";
            }else{
                if (!password_verify($password, $user->getPassword())) {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $errorMsg = "invalid-password";
                }
            }
        }

        if (!empty($errorMsg)) {
            Utils::redirect("login&error=" . urlencode($errorMsg));
        }else{
            $_SESSION['user'] = $user;
            $_SESSION['idUser'] = $user->getId();
            Utils::redirect("profile&id={$_SESSION['idUser']}");
        }
    }

    public function signupUser() : void 
    {
        $username = Utils::request("pseudo");
        $email = Utils::request("email");
        $password = Utils::request("password");
        if (empty($username) || empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires. 1");
        }
        $userManager = new UserManager();
        $user = $userManager->getUserByLogin($email);
        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $user->getId();
        Utils::redirect("profile&id={$_SESSION['idUser']}");
    }

    public function disconnectUser() : void 
    {
        unset($_SESSION['user']);
        Utils::redirect("home");
    }

}