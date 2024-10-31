<?php

namespace iutnc\deefy\action;

use iutnc\deefy\auth\AuthnProvider;
use iutnc\deefy\exception\AuthnException;

class SigninAction extends Action
{
    public function __construct()
    {
        parent::__construct();
    }

    public function execute(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $passwd = filter_var($_POST['passwd'], FILTER_SANITIZE_SPECIAL_CHARS);

            try {
                AuthnProvider::signin($email, $passwd);
                $_SESSION['user'] = $email;
                return "Authentication successful. Welcome, $email!";
            } catch (AuthnException $e) {
                return "Authentication failed: " . $e->getMessage();
            }
        } else {
            return $this->renderForm();
        }
    }

    private function renderForm(): string
    {
        return <<<HTML
        <form method="post" action="?action=signin">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="passwd">Password:</label>
            <input type="password" id="passwd" name="passwd" required>
            <button type="submit">Sign In</button>
        </form>
        HTML;
    }
}