<?php

namespace iutnc\deefy\action;

class AddUserAction extends Action
{
    public function execute(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $age = filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT);

            return "Nom: $name, Email: $email, Age: $age ans";
        } else {
            return $this->renderForm();
        }
    }

    private function renderForm(): string
    {
        return <<<HTML
        <form method="post" action="?action=add-user">
            <label for="name">Nom:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="age">Âge:</label>
            <input type="number" id="age" name="age" required>
            <button type="submit">Connexion</button>
        </form>
        HTML;
    }
}