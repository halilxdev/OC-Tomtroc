<?php

/**
 * Classe qui gère les livres.
 */
class UserManager extends AbstractEntityManager 
{
    public function getAllUsers() : array
    {
        $sql = "SELECT * FROM users";
        $result = $this->db->query($sql);
        $users = [];
        while ($user = $result->fetch()) {
            $users[] = new User($user);
        }
        return $users;
    }
    
    public function getUserById(int $id) : ?User
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $user = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }

}