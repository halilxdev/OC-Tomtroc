<?php

/**
 * Classe qui gère les utilisateurs.
 */
class MessageManager extends AbstractEntityManager 
{
    public function getAllMessages() : array
    {
        $sql = "SELECT * FROM messages";
        $result = $this->db->query($sql);
        $messages = [];
        while ($message = $result->fetch()) {
            $messages[] = new Message($message);
        }
        return $messages;
    }

    public function getAllMessagesForUser($user): array
    {
        $sql = "SELECT * FROM messages WHERE to_user = :user OR from_user = :user";
        $result = $this->db->query($sql, ['user' => $user]);
        $messages = [];
        while ($message = $result->fetch()) {
            $messages[] = new Message($message);
        }
        return $messages;
    }

    public function getNbOfUnseen($user): int
    {
        $sql = "SELECT * FROM messages WHERE to_user = :to_user AND status = 'unseen'";
        $result = $this->db->query($sql, ['to_user' => $user]);
        $nb = 0;
        while ($message = $result->fetch()) {
            $nb++;
        }
        return $nb;
    }
}