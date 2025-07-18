<?php 

class MessageController 
{
    /**
     * Affichage de la liste des messages.
     * @return void
     */
    public function showList() : void
    {
        $MessageManager = new MessageManager();
        $messages = $MessageManager->getAllMessagesForUser($_SESSION['idUser']);
        $view = new View("Messages");
        $view->render("message-list", [
            'messages'      => $messages
        ]);
    }
}