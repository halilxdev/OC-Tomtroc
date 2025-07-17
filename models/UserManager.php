<?php

/**
 * Classe qui gère les utilisateurs.
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

    public function getAllEmails() : array
    {
        $sql = "SELECT email FROM users";
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

    public function getUserByLogin(string $email) : ?User 
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $result = $this->db->query($sql, ['email' => $email]);
        $user = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }

    public function newUser(string $username, string $email, string $password) : void 
    {
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $this->db->query($sql, [
            'username' => $username,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

    public function updateUser(int $id, array $data) : void
    {
        $fields = [];
        $params = ['id' => $id];

        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
            $params[$key] = $value;
        }

        $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = :id";
        $this->db->query($sql, $params);
    }

}