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
        $convosList = $MessageManager->getAllConvos($_SESSION['idUser']);

        $convos = [];
        foreach($convosList as $m){
            $sender = $m->getFromUser();
            $senderId = $sender->getId();
            $senderPfp = $sender->getProfilePicture();
            $senderUsername = $sender->getUsername();

            $sentAt = $m->getSentAt();
            $now = new DateTime();

            if ($sentAt->format('Y-m-d') === $now->format('Y-m-d')) {
                $convoDate = $sentAt->format('H:i');
            } else {
                $convoDate = $sentAt->format('d/m/Y');
            }
            $status = $m->getStatus();

            $convos[] = [
                'senderId'              => $senderId,
                'senderPfp'             => $senderPfp,
                'senderUsername'        => $senderUsername,
                'content'               => $m->getContent(),
                'convoDate'             => $convoDate,
                'status'                => $status
            ];
        }

        $receiverData = [];
        $chat = [];
        if(isset($_GET['fromUser'])){
            $UserManager = new UserManager();
            $receiver = $UserManager->getUserById($_GET['fromUser']);
            $receiverData = [
                'id'        => $receiver->getId(),
                'pfp'       => $receiver->getProfilePicture(),
                'username'  => $receiver->getUsername()   
            ];

            $chatArray = $MessageManager->getAllMessagesBetween($_GET['fromUser'], $_SESSION['idUser']);

            $chat = [];

            foreach ($chatArray as $c) {
                $c->setStatus('seen');
                $fromUserId = $c->getFromUser()->getId();
                $fromUserPfp = $c->getFromUser()->getProfilePicture();
                $status = ($fromUserId === $_SESSION['idUser']) ? 'chatSent' : 'chatReceived';

                $chat[] = [
                    'from_user' => $fromUserId,
                    'status'    => $status,
                    'content'   => $c->getContent(),
                    'senderPfp' => $fromUserPfp
                ];
            }

        }

        $view = new View("Messages");
        $view->render("message-list", [
            'convos'        => $convos,
            'receiver'      => $receiverData,
            'chat'          => $chat
        ]);
    }
}