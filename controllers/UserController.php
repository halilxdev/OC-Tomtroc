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

    public function showProfile(string $errors = '', string $success = '') : void
    {
        if (empty($success) && isset($_GET['success'])) {
            $errors = htmlspecialchars($_GET['success']); // sécurité
        }
        if (empty($errors) && isset($_GET['error'])) {
            $errors = htmlspecialchars($_GET['error']); // sécurité
        }

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
                $date = $b->getCreatedAt();
                $booksArray[] = [
                    'id'            => $b->getId(),
                    'image'         => $b->getCoverImage(),
                    'title'         => $b->getTitle(),
                    'status'        => $b->getStatus(),
                    'author'        => $b->getAuthor(),
                    'description'   => $b->getDescription(100),
                    'date'          => $date
                ];
            }
            usort($booksArray, fn($a, $b) => $b['date'] <=> $a['date']);
        }

        $view = new View("{$user_username}");

        if(isset($_SESSION['user'])){
            $userId = $_SESSION['idUser'];
            
        }

        
        if((isset($userId)) && ($askedId == $userId)){
            $view->render("my-profile", [
            'user'          => $user,
            'user_books'    => $booksArray,
            'successMsg'    => $success,
            'errorMsg'      => $errors
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
        $username = Utils::request("username");
        $email = Utils::request("email");
        $password = Utils::request("password");
        $errorMsg = '';

        if (empty($username) || empty($email) || empty($password)) {
            // On vérifie si tous les champs sont complets
            $errorMsg = "incomplete-fields";
        }else{
            if(strlen($username) > 21){
                // On vérifie la longueur du pseudo
                $errorMsg = "username-length";
            }else{
                $userManager = new UserManager();
                $allEmails = $userManager->getAllEmails();

                // On vérifie si l'adresse email existe dans la base de données
                foreach ($allEmails as $a) {
                    if ($a->getEmail() === $email) {
                        $errorMsg = "existing-email";
                        break;
                    }
                }
                if(strlen($password) > 21){
                    // On vérifie la longueur du mot de passe
                    $errorMsg = "password-length";
                }
            }

        }

        if (!empty($errorMsg)) {
            Utils::redirect("signup&error=" . urlencode($errorMsg));
        }else{
            $userManager->newUser($username, $email, $password);
            $user = $userManager->getUserByLogin($email);
            $_SESSION['user'] = $user;
            $_SESSION['idUser'] = $user->getId();
            Utils::redirect("profile&id={$_SESSION['idUser']}");
            $successMsg = 'valid';
            $this->showProfile('', $successMsg);
        }
    }

    public function updateUser() : void
    {
        // Récupération de l'utilisateur actuel (ex: depuis la session)
        $userManager = new UserManager();
        $oldUser = $userManager->getUserById($_SESSION['idUser']);

        // Initialisation des variables
        $username = $oldUser->getUsername();
        $email = $oldUser->getEmail();
        $password = null;
        $avatar = $oldUser->getProfilePicture();
        $errorMsg = '';

        // Récupération conditionnelle des champs du formulaire
        if (null !== Utils::request("username")) {
            $usernameInput = Utils::request("username");
            if ($usernameInput !== $oldUser->getUsername()) {
                if (strlen($usernameInput) < 3 || strlen($usernameInput) > 20) {
                    $errorMsg = "username-length-invalid";
                } else {
                    $username = $usernameInput;
                }
            }
        }

        if (null !== Utils::request("email")) {
            $emailInput = Utils::request("email");

            if ($emailInput !== $oldUser->getEmail()) {
                if (!filter_var($emailInput, FILTER_VALIDATE_EMAIL)) {
                    $errorMsg = "email-invalid";
                } else {
                    $email = $emailInput;
                }
            }
        }

        if (null !== Utils::request("password") && Utils::request("password") !== '') {
            $passwordInput = Utils::request("password");

            if (strlen($passwordInput) < 3) {
                $errorMsg = "password-too-short";
            } else {
                $password = password_hash($passwordInput, PASSWORD_DEFAULT);
            }
        }

        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $fileTmp = $_FILES['avatar']['tmp_name'];
            $fileName = $_FILES['avatar']['name'];
            $fileSize = $_FILES['avatar']['size'];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $allowed = ['jpg', 'jpeg', 'png'];

            if (!in_array($fileExt, $allowed)) {
                $errorMsg = "avatar-invalid-format";
            } elseif ($fileSize > 2 * 1024 * 1024) { // 2MB
                $errorMsg = "avatar-too-large";
            } else {
                // Move the file
                $newFileName = uniqid("avatar_") . "." . $fileExt;
                move_uploaded_file($fileTmp, "./public/images/profile-pictures/" . $newFileName);
                $avatar = "public/images/profile-pictures/" . $newFileName;
            }
        }

        
        if (!empty($errorMsg)) {
            $this->showProfile($errorMsg);
            exit;
        }

        $dataToUpdate = [
            'username' => $username,
            'email' => $email,
            'profile_picture' => $avatar
        ];

        if ($password !== null) {
            $dataToUpdate['password'] = $password;
        }

        // MAJ utilisateur
        $userManager->updateUser($oldUser->getId(), $dataToUpdate);

        // Redirection OK
        $successMsg = 'valid';
        $this->showProfile('', $successMsg);
        
    }

    public function disconnectUser() : void 
    {
        unset($_SESSION['user']);
        unset($_SESSION['idUser']);
        Utils::redirect("home");
    }

}