<?php 

class UserController 
{

    public function showLogin() : void
    {
        $view = new View("Connexion");
        $view->render("login");
    }
    public function showSignup() : void
    {
        $view = new View("Inscription");
        $view->render("signup");
    }

    public function showProfile() : void
    {
        if(isset($_GET['id'])){
            $askedId = $_GET['id'];
            $userManager = new UserManager();
            $user = $userManager->getUserById($_GET['id']);
            $username = $user->getUsername();
        }
        if(isset($_SESSION['user'])){
            $userId = $_SESSION['idUser'];
        }

        $view = new View("{$username}", ['user' => $user]);
        if($askedId == $userId){
            $view->render("my-profile");
        }else{
            $view->render("see-profile");
        }
    }



    private function checkIfUserIsConnected() : void
    {
        if (!isset($_SESSION['user'])) {
            Utils::redirect("login");
        }
    }

    public function connectUser() : void 
    {
        $email = Utils::request("email");
        $password = Utils::request("password");
        if (empty($email) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires. 1");
        }
        $userManager = new UserManager();
        $user = $userManager->getUserByLogin($email);
        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }
        if (!password_verify($password, $user->getPassword())) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            throw new Exception("Le mot de passe est incorrect : $hash");
        }
        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $user->getId();
        Utils::redirect("profile&id={$_SESSION['idUser']}");
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