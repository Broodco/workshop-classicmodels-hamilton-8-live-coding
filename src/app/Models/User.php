<?php

namespace App\Models;

class User extends Database
{
    public function findByUsername(string $username): array|false
    {
        $stmt = $this->query(
            "SELECT * FROM users WHERE username = ?",
            [$username]
        );

        return $stmt->fetch();
    }

    public function registerNewUserAndReturnId(string $username, string $email, string $passwordHash): string
    {
        $this->query(
            "
                INSERT INTO users (username, email, password) 
                VALUES (?, ?, ?)
            ",
            [$username, $email, $passwordHash]
        );

        return $this->lastInsertId();
    }
}