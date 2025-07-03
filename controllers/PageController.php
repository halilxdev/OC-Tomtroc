<?php

class PageController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome() : void
    {
        $bookManager = new BookManager();
        $books = $bookManager->getAllBooks();
        $view = new View("Accueil");
        $view->render("home", ['books' => $books]);
    }
}