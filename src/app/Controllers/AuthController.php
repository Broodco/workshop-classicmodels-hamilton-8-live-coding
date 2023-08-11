<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use Exception;

class AuthController
{
    public function register(string $usernameInput, string $emailInput, string $passwordInput)
    {
        if (empty($usernameInput) || empty($emailInput) || empty($passwordInput)) {
            throw new Exception('Formulaire non complet');
        }

        $username = htmlspecialchars($usernameInput);
        $email = filter_var($emailInput, FILTER_SANITIZE_EMAIL);
        $passwordHash = password_hash($passwordInput, PASSWORD_DEFAULT);

        $id = (new User())->registerNewUserAndReturnId(
            $username,
            $email,
            $passwordHash
        );

        $_SESSION['user'] = [
            'id' => $id,
            'username' => $username,
            'email' => $email
        ];

        http_response_code(302);
        header('location: /');
    }

    public function showRegistrationForm()
    {
        include 'app/views/layout/header.view.php';
        include 'app/views/register.view.php';
        include 'app/views/layout/footer.view.php';
    }

    public function login(string $usernameInput, string $passwordInput)
    {
        if (empty($usernameInput) || empty($passwordInput)) {
            throw new Exception('Formulaire non complet');
        }

        $username = htmlspecialchars($usernameInput);

        $user = (new User())->findByUsername($username);

        if (empty($user)) {
            throw new Exception('Mauvais nom d\'utilisateur');
        }

        if (password_verify($passwordInput, $user['password']) === false) {
            throw new Exception('Mauvais mot de passe');
        }

        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $username,
            'email' => $user['email']
        ];

        // Redirect to home page
        http_response_code(302);
        header('location: /');
    }

    public function showLoginForm()
    {
        include 'app/views/layout/header.view.php';
        include 'app/views/login.view.php';
        include 'app/views/layout/footer.view.php';
    }

    public function logout()
    {
        unset($_SESSION['user']);
        http_response_code(302);
        header('location: /');
    }
}