<?php

require_once 'config/config.php';
require_once 'config/autoload.php';

// On récupère l'action demandée par l'utilisateur.
// Si aucune action n'est demandée, on affiche la page d'accueil.
$action = Utils::request('action', 'home');

try {
    switch ($action) {
        case 'home':
            $pageManager = new PageController();
            $pageManager->showHome();
            break;

        // Pages publiques
        case 'books-list':
            break;
        case 'book-detail':
            break;
        case 'messages':
            break;
        case 'signup':
            break;
        case 'signin':
            break;
        case 'account':
            break;
        case 'privacy':
            break;
        case 'legal':
            break;
        
        // Réservé aux utilisateurs connectés
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

        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
