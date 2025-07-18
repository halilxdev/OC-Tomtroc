<?php

require_once 'config/config.php';
require_once 'config/autoload.php';

// On récupère l'action demandée par l'utilisateur.
// Si aucune action n'est demandée, on affiche la page d'accueil.
$action = Utils::request('action', 'home');

try {
    switch ($action) {


        // Pages publiques

        case 'home':
            $page = new BookController();
            $page->showHome();
            break;
        case 'books-list':
            $page = new BookController();
            $page->showList();
            break;
        case 'book-detail':
            $page = new BookController();
            $page->showBook();
            break;
        case 'signup':
            $page = new UserController();
            $page->showSignup();
            break;
        case 'signupUser':
            $page = new UserController();
            $page->signupUser();
            break;
        case 'login':
            $page = new UserController();
            $page->showLogin();
            break;
        case 'connectUser':
            $page = new UserController();
            $page->connectUser();
            break;
        case 'profile':
            $page = new UserController();
            $page->showProfile();
            break;
        case 'privacy':
            $page = new BookController();
            $page->showPrivacy();
            break;
        case 'legal':
            $page = new BookController();
            $page->showLegal();
            break;
        
        // Réservé aux utilisateurs connectés
        case 'log-out': 
            $page = new UserController();
            $page->disconnectUser();
            break;
        case 'updateUser':
            $page = new UserController();
            $page->updateUser();
            break;
        case 'listOfMsg':
            $page = new MessageController();
            $page->showList();
            break;
        case 'add-book': 
            $page = new BookController();
            $page->showAddBook();
            break;
        case 'addBook':
            $page = new BookController();
            $page->addBook();
            break;
        case 'edit-book':
            $page = new BookController();
            $page->showEditBook();
            break;
        case 'updateBook':
            $page = new BookController();
            $page->editBook();
            break;
        case 'deleteBook': 
            $page = new BookController();
            $page->deleteBook();
            break;
        case 'message': 
            break;
        case 'send-message':
            break;

        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    $errorView = new View('Erreur');
    $errorView->render('error-page', ['errorMessage' => $e->getMessage()]);
}
