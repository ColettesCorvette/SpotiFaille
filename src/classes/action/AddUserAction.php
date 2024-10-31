<?php

namespace iutnc\deefy\action;

use iutnc\deefy\auth\AuthnProvider;
use iutnc\deefy\exception\AuthnException;

class AddUserAction extends Action
{
    public function execute(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $passwd = filter_var($_POST['passwd'], FILTER_UNSAFE_RAW);
            $passwdConfirm = filter_var($_POST['passwd_confirm'], FILTER_UNSAFE_RAW);

            if ($passwd !== $passwdConfirm) {
                return "Passwords do not match.";
            }

            try {
                AuthnProvider::register($email, $passwd);
                return "Registration successful. Welcome, $email!";
            } catch (AuthnException $e) {
                return "Registration failed: " . $e->getMessage();
            }
        }

        return $this->renderForm();

    }

    private function renderForm(): string
    {
        return <<<HTML
        <form method="post" action="?action=add-user">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="passwd">Password:</label>
            <input type="password" id="passwd" name="passwd" required>
            <label for="passwd_confirm">Confirm Password:</label>
            <input type="password" id="passwd_confirm" name="passwd_confirm" required>
            <button type="submit">Register</button>
        </form>
        HTML;
    }
}