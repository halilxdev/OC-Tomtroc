<?php

require_once 'config/config.php';
require_once 'config/autoload.php';

// On récupère l'action demandée par l'utilisateur.
// Si aucune action n'est demandée, on affiche la page d'accueil.
$action = Utils::request('action', 'home');

try {
    switch ($action) {

        // Pages admin

        case 'debug':
            $page = new AdminController();
            $page->showDebug();
            break;

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
        case 'account':
            break;
        case 'privacy':
            break;
        case 'legal':
            break;
        
        // Réservé aux utilisateurs connectés
        case 'log-out': 
            $page = new UserController();
            $page->disconnectUser();
            break;
        case 'update-account': 
            break;
        case 'delete-account': 
            break;
        case 'create-book': 
            break;
        case 'update-book': 
            break;
        case 'delete-book': 
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
