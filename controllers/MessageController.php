<?php 

class MessageController 
{
    /**
     * Affichage de la liste des messages.
     * @return void
     */
    public function showList() : void
    {
        $view = new View("Messages");
        $view->render("message-list");
    }
}