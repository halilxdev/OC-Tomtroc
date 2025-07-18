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

    public function getAllMessagesBetween($from, $to): array
    {
        $sql = "
            SELECT * FROM messages 
            WHERE 
                (to_user = :to AND from_user = :from)
                OR 
                (to_user = :from AND from_user = :to)
            ORDER BY sent_at DESC
        ";

        $result = $this->db->query($sql, [
            'to'   => $to,
            'from' => $from
        ]);

        $messages = [];
        while ($message = $result->fetch()) {
            $messages[] = new Message($message);
        }
        return $messages;
    }

    public function getAllConvos($user): array
    {
        $sql = "SELECT * FROM messages
                WHERE to_user = :user
                AND sent_at = (
                SELECT MAX(sent_at)
                    FROM messages AS m2
                    WHERE m2.from_user = messages.from_user AND m2.to_user = :user
                )
                ORDER BY sent_at DESC
        ";
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

    public function sendNewMsg($from, $to, $content): void
    {
        $sql = "INSERT INTO messages (from_user, to_user, content, status, sent_at)
                VALUES (:from_user, :to_user, :content, :status, :sent_at)";

        $this->db->query($sql, [
            'from_user' => $from,
            'to_user'   => $to,
            'content'   => $content,
            'status'    => 'unseen',
            'sent_at'   => (new DateTime())->format('Y-m-d H:i:s')
        ]);
    }

}