<?php

class PageController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome() : void
    {
        $view = new View("Accueil");
        $view->render("home");
    }
}