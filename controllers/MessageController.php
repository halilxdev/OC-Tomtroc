<?php 

class MessageController 
{
    /**
     * Affichage de la liste des messages.
     * @return void
     */
    public function showList(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content'], $_GET['fromUser'])) {
            $MessageManager = new MessageManager();
            $from = $_SESSION['idUser'];
            $to = $_GET['fromUser'];
            $content = trim($_POST['content']);
            if (!empty($content)) {
                $MessageManager->sendNewMsg($from, $to, $content);
            }
            Utils::redirect('listOfMsg&fromUser=' . urlencode($to));
            exit;
        }

        $MessageManager = new MessageManager();
        $convosList = $MessageManager->getAllConvos($_SESSION['idUser']);

        $convos = [];
        foreach ($convosList as $m) {
            $sender = $m->getFromUser();
            $senderId = $sender->getId();
            $senderPfp = $sender->getProfilePicture();
            $senderUsername = $sender->getUsername();

            $sentAt = $m->getSentAt();
            $now = new DateTime();

            $convoDate = ($sentAt->format('Y-m-d') === $now->format('Y-m-d'))
                ? $sentAt->format('H:i')
                : $sentAt->format('d/m/Y');

            $status = $m->getStatus();

            $convos[] = [
                'senderId'       => $senderId,
                'senderPfp'      => $senderPfp,
                'senderUsername' => $senderUsername,
                'content'        => $m->getContent(),
                'convoDate'      => $convoDate,
                'status'         => $status
            ];
        }

        $receiverData = [];
        $chat = [];

        if (isset($_GET['fromUser'])) {
            $UserManager = new UserManager();
            $receiver = $UserManager->getUserById($_GET['fromUser']);
            $receiverData = [
                'id'       => $receiver->getId(),
                'pfp'      => $receiver->getProfilePicture(),
                'username' => $receiver->getUsername()
            ];

            $chatArray = $MessageManager->getAllMessagesBetween($_GET['fromUser'], $_SESSION['idUser']);

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
            'convos'   => $convos,
            'receiver' => $receiverData,
            'chat'     => $chat
        ]);
    }

}